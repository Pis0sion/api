<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/11/6
 * Time: 10:37
 */

namespace app\api\behavior;

use app\grant\model\ProductListModel;
use app\grant\model\GrantModel;

class CallNumbers
{
    public function run($params)
    {
        extract(request()->param());
        $ip = request()->ip(0,true);
        $ip = '101.132.172.189';
        $productList = ProductListModel::where('product_value',$channel)->find();
        $call_numbers = GrantModel::where('ip',$ip)->where('product_id',$productList['id'])->value('call_numbers');
        if($call_numbers != -1)
        {
            GrantModel::where('ip',$ip)->where('product_id',$productList['id'])->dec('call_numbers')->update();
        }
    }
}