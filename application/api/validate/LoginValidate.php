<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/2
 * Time: 14:00
 */

namespace app\admin\validate;


class LoginValidate extends BaseValidate
{
    protected $rule = [
        "phoneNum" => "require|isMobile",
        "password" => 'require|isPassword',
    ];

    protected $message = [
        'phoneNum.require' => '请填写手机号',
        'phoneNum.isMobile' => '手机号不正确',
        'password.require' => '请填写密码',
        'password.isPassword' => '请输入6-18位数字，字母或下划线',
    ];

}