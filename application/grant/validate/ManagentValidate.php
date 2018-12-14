<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/29
 * Time: 10:13
 */

namespace app\grant\validate;


use app\api\validate\BaseValidate;

class ManagentValidate extends BaseValidate
{
    protected $rule = [
        "username" => "require|isRule",
        "password" => 'require|confirm:repassword|isRule',
    ];

    protected $message = [
        'username.require' => '请填写账号',
        'username.isRule' => '请填写6-18位数字、字母或下划线的账号',
        'password.require' => '请填写密码',
        'password.confirm' => '确认密码不正确',
        'password.isRule' => '请填写6-18位数字、字母或下划线的密码',
    ];
}