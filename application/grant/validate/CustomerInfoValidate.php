<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/29
 * Time: 14:31
 */

namespace app\grant\validate;


use app\api\validate\BaseValidate;

class CustomerInfoValidate extends BaseValidate
{
    protected $rule = [
        "customer_name" => "require",
    ];

    protected $message = [
        'customer_name.require' => '请填写授权公司/平台名称',
    ];
}