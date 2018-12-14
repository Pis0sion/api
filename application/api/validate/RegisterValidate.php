<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/8
 * Time: 16:02
 */

namespace app\api\validate;


class RegisterValidate extends BaseValidate
{
    protected $rule = [
        "requestId" => "require|max:20",
        "bindMobile" => "require|mobile",
        "signedName" => "require|max:20",
        "linkMan" => "require|max:20",
        "idCard" => "require|idCard",
        "legalPerson" => "require|max:20",
        "bankAccountNumber" => "require|isBank",
        "bankName" => "require|max:50",
        "accountName" => "require|max:20",
    ];

    protected $message = [
        'requestId.require' => '请填写注册请求号',
        'requestId.max' => '注册请求号最大为20位',
        'bindMobile.require' => '请填写绑定手机号',
        'bindMobile.mobile' => '绑定手机号不合法',
        'signedName.require' => '请填写签约名',
        'signedName.max' => '签约名最大为20位',
        'linkMan.require' => '请填写推荐人',
        'linkMan.max' => '推荐人最大为20位',
        'idCard.require' => '请填写身份证号',
        'idCard.idCard' => '身份证号不正确',
        'legalPerson.require' => '请填写商户法人姓名',
        'legalPerson.max' => '商户法人姓名最大为20位',
        'bankAccountNumber.require' => '请填写银行卡号',
        'bankAccountNumber.isBank' => '银行卡号格式不正确',
        'bankName.require' => '请填写银行卡开户行',
        'bankName.max' => '银行卡开户行最大为50位',
        'accountName.require' => '请填写银行开户名',
        'accountName.max' => '银行开户名最大为20位',
    ];
}