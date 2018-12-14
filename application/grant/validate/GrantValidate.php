<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/27
 * Time: 15:18
 */

namespace app\grant\validate;


use app\api\validate\BaseValidate;

class GrantValidate extends BaseValidate
{
    protected $rule = [
        "ip" => "require|ip",
        'customer_id' => 'require',
        'product_id' => 'require',
        'authorization_time' => 'require|date',
        'call_numbers' => 'egt:-1',
    ];

    protected $message = [
        'ip.require' => '请填写授权IP',
        'ip.ip' => 'IP授权格式不正确',
        'customer_id.require' => '请选择授权所属公司/平台',
        'product_id.require' => '请选择授权产品',
        'authorization_time.require' => '请填写授权日期',
        'authorization_time.date' => '授权日期格式不正确',
        'call_numbers.egt' => '授权调用次数只能为正整数或者-1',
    ];
}