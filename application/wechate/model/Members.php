<?php

namespace app\wechate\model;

use think\Db;
use think\Model;

class Members extends Model
{
    //获取店铺信息
    public function getShopIdAttr($value)
    {
        $shop = Db::name('shops')->where('id',$value)->value('shop_name');
        return  $shop;
    }
    public function getStatusAttr($value)
    {
        $status = [-1=>'已取消',0=>'待支付',1=>'待发货',2=>'已完成'];
        return $status[$value];
    }
}
