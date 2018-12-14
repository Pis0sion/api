<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/24
 * Time: 16:02
 */

namespace app\api\validate;


class BindOrPay extends BaseValidate
{
    protected $rule = [
        "customerNumber" => "require|length:11",
        'requestId' => 'require|max:20',
        'callbackUrl' => 'require|max:200|isUrl',
        'bankCardNo' => 'require|max:20',
        'bindMobile' => 'require|isMobile',
    ];
    protected $message = [
        'customerNumber.require' => '请填写子商户编号',
        'customerNumber.length' => '子商户编号长度必须是11位',
        'requestId.require' => '请填写绑卡请求订单号',
        'requestId.max' => '绑卡请求订单号最大为20位',
        'callbackUrl.require' => '请填写绑卡成功回调地址',
        'callbackUrl.isUrl' => '绑卡回调地址格式错误',
        'callbackUrl.max' => '回调地址最大为200位',
        'bankCardNo.require' => '请填写所绑定的银行卡号',
        'bankCardNo.max' => '银行卡号最大为20位',
        'bindMobile.require' => '请填写银行预留手机号',
        'bindMobile.isMobile' => '请填写正确的手机号',
    ];
}