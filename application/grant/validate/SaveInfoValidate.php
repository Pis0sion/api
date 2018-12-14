<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/29
 * Time: 11:36
 */

namespace app\grant\validate;


use app\api\validate\BaseValidate;

class SaveInfoValidate extends BaseValidate
{
    protected $rule = [
        "oldpassword" => "require",
        "password" => "require|isRule|confirm:repassword",
    ];

    protected $message = [
        'oldpassword' => '请填写原始密码',
        'password.require' => '请填写新密码',
        'password.isRule' => '请填写6-18位数字、字母或下划线的新密码',
        'password.confirm' => '确认新密码不正确',
    ];
}