<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/2
 * Time: 14:00
 */

namespace app\api\validate;


class MobileValidate extends BaseValidate
{
    protected $rule = [
        "mobilePhone" => "require|isMobile",
    ];

    protected $message = [
        'mobilePhone.require' => '请填写手机号',
        'mobilePhone.isMobile' => '手机号不正确',
    ];

}