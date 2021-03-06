<?php

namespace app\wechate\controller;

use EasyWeChat\Foundation\Application;
use think\Controller;

class BaseController extends Controller
{
    public function _initialize()
    {
        //调用授权
        $app = new Application(config('wx'));
        $oauth = $app->oauth;
        $url=strtolower("/".request()->module()."/".request()->controller()."/".request()->action());

// 未登录
        if (!session('wechat_user')) {

           session('target_url',$url);

                $oauth->redirect()->send();
            // 这里不一定是return，如果你的框架action不是返回内容的话你就得使用
            // $oauth->redirect()->send();
        }

// 已经登录过
//        $user = session('wechat_user');

        parent::_initialize(); // TODO: Change the autogenerated stub
    }

}
