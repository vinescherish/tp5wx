<?php

namespace app\wechate\controller;

use EasyWeChat\Foundation\Application;
use think\Controller;
use think\Db;

class MemberController extends BaseController
{
    public function index()
    {
        $user = session('wechat_user');
        halt($user);
    }

    /**
     * 用户绑定
     */
    public function bind()
    {
        $app = new Application(config('wx'));

        $notice = $app->notice;

        //取出当前微信用户信息
        $member = session('wechat_user');
        //取出微信ID
        $openId = $member['id'];
        //判断是否绑定
        $bind = Db::name('members')->where('open_id', $openId)->find();
        if (request()->post()) {
            $data = request()->post();
            //判断用户名是否存在
            $user = Db::name('members')->where('username', $data['username'])->find();

            if ($user && password_verify($data['password'], $user['password'])) {
                //把微信ID 存入$data
                //入库
                $result = Db::name('members')->where('id', $user['id'])->update(['open_id' => $openId]);
                if ($result) {
                    //发送模板消息
                    $userId = $openId;
                    $templateId = 'im00Pbq5jKwYrA1gAleCDZe9MNiCU_FEPXPgL7dE6-c';
                    $url = 'https://www.easywechat.com';
                    $data = array(
                        "first" => "恭喜您绑定成功",
                        "remark" => "感谢您的使用",
                    );
                    $messageId = $notice->to($userId)->uses($templateId)->andUrl($url)->data($data)->send();

                    return $this->success('绑定成功', 'info');
                }
            } else {
                return $this->error('用户名或密码不正确');
            }

            //入库
        }

        return view('bind', compact('bind'));
    }

    /**
     * 解除账号绑定
     */
    public function kill()
    {
        $app = new Application(config('wx'));

        $notice = $app->notice;

        //取出当前微信用户信息
        $member = session('wechat_user');
        //取出微信ID
        $openId = $member['id'];
        //判断找到当前用户
        $user = Db::name('members')->where('open_id', $openId)->find();
        //删除open_id
        if ($user && Db::name('members')->where('id', $user['id'])->update(['open_id' => null])) {
            //发送模板消息
            $userId = $openId;
            $templateId = 'im00Pbq5jKwYrA1gAleCDZe9MNiCU_FEPXPgL7dE6-c';
            $url = 'https://www.easywechat.com';
            $data = array(
                "first" => "您已解除账号绑定",
                "remark" => "欢迎下次使用",
            );

            $messageId = $notice->to($userId)->uses($templateId)->andUrl($url)->data($data)->send();


            return $this->success('解除绑定成功', 'bind');
        }

    }

    /**
     * 用户详情信息
     */
    public function info()
    {
        //取出当前微信用户信息
        $member = session('wechat_user');
        //取出微信ID
        $openId = $member['id'];
        //找到当前用户
        $user = Db::name('members')->where('open_id', $openId)->find();
        //判断是否绑定
        if ($user) {
            return view('info', compact('user'));
        } else {
            return $this->error('你还没有绑定账号', 'bind');
        }

    }

    /**
     * 订单详情
     */
    public function order()
    {
        //取出当前微信用户信息
        $member = session('wechat_user');
        //取出微信ID
        $openId = $member['id'];
        //找到当前用户
        $user = Db::name('members')->where('open_id', $openId)->find();
        //取出订单信息
        if ($user) {
            $orders = Db::name('orders')->where('user_id', $user['id'])->select();
            return view('order', compact('orders'));
        } else {
            return $this->error('你还没有绑定账号', 'bind');
        }
    }


}
