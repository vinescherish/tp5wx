<?php

namespace app\wechate\controller;

use EasyWeChat\Foundation\Application;
use EasyWeChat\Message\News;
use EasyWeChat\Message\Text;
use think\Controller;
use think\Db;

class ServerController extends Controller
{
    //打通服务器
    public function index()
    {
        // 使用配置来初始化一个项目。
        $app = new Application(config('wx'));
        //接收处理回复消息
        $server = $app->server;
        $server->setMessageHandler(function ($message) {
            //hot_goods点击事件
            if ($message->EventKey === "hot_goods" || $message->Content === "热销商品") {
                //取出5条最新商品
                $goods = Db::name('menuses')->order('id', 'desc')->limit(5)->select();
                //循环
                $goodAll = [];
                foreach ($goods as $good) {
                    $news = new News();

                    $news->title = $good['goods_name'];
                    $news->description = $good['discription'];
                    $news->url = "http://wxapp.cherishs.cn/wechate/member/detail" . $good['id'];
                    $news->image = $good['goods_img'];

                    $goodAll[] = $news;
                }
                return $goodAll;
            }
            //解除绑定
            if ($message->Content === "解除绑定") {
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


                    return "解除绑定成功";
                }
                return "你还没有绑定";
            }
            //帮助信息
            if ($message->Content === "帮助") {
                $text = new Text(['content' => "请咨询13290022930"]);
                return $text;
            }
        });
        $response = $app->server->serve();

// 将响应输出
        $response->send();
    }

//处理授权回调
    public function call()
    {
        $app = new Application(config('wx'));
        $oauth = $app->oauth;

// 获取 OAuth 授权结果用户信息
        $user = $oauth->user();

        session('wechat_user', $user->toArray());

        $targetUrl = session('target_url') ?? "/";


//        header('location:'. $targetUrl); // 跳转到 user/profile
        return $this->redirect($targetUrl);
    }

    /**
     * 获取菜单
     */
    public function getMenu()
    {
        //得到菜单
        $app = new Application(config('wx'));
        //操作菜单的对象
        $menu = $app->menu;
        //得到所有菜单
        halt($menu->all());
    }

    /*
     *添加设置菜单
     */
    public function setMenu()
    {

        $buttons = [
            [
                "type" => "click",
                "name" => "热销商品",
                "key" => "hot_goods"
            ],
            [
                "name" => "个人中心",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "我的信息",
                        "url" => "http://wxapp.cherishs.cn/wechate/member/info"
                    ],
                    [
                        "type" => "view",
                        "name" => "我的订单",
                        "url" => "http://wxapp.cherishs.cn/wechate/member/order"
                    ],
                    [
                        "type" => "view",
                        "name" => "绑定账号",
                        "url" => "http://wxapp.cherishs.cn/wechate/member/bind"
                    ],
                ],
            ],
        ];


        $app = new Application(config('wx'));
        //操作菜单的对象
        $menu = $app->menu;
        $menu->add($buttons);
    }
}
