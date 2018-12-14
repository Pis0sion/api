<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/8
 * Time: 11:21
 */

namespace app\api\validate;


class CustomerNoValidate extends BaseValidate
{
    protected $rule = [
        "customerNumber" => "require|length:11",
        'bankCardNumber' => 'isBank',
        'bankName' => 'max:50',
        'bindMobile' => 'isMobile',
        'areaCode' => 'max:4',
        'mailStr' => 'email|max:50',
    ];

    protected $message = [
        'customerNumber.require' => '请填写子商户编号',
        'customerNumber.length' => '子商户编号必须为11位',
        'bankCardNumber.isBank' => '银行卡号格式不正确',
        'bankName.max' => '开户行最多为50位',
        'bindMobile.isMobile' => '手机号格式不正确',
        'areaCode.max' => '地区码最大为4位',
        'mailStr.email' => '邮箱格式不正确',
        'mailStr.max' => '邮箱最大为50位',
    ];
}