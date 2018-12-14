<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/25
 * Time: 16:52
 */

namespace app\grant\validate;


use app\api\validate\BaseValidate;

class LoginValidate extends BaseValidate
{
    protected $rule = [
        "username" => "require|isRule",
        "password" => 'require|isRule',
    ];

    protected $message = [
        'username.require' => '请填写账号',
        'username.isRule' => '请输入6-18位数字，字母或下划线的账号',
        'password.require' => '请填写密码',
        'password.isRule' => '请输入6-18位数字，字母或下划线的密码',
    ];
}