<?php
/**
 * Created by PhpStorm.
 * User: pis0sion
 * Date: 18-10-24
 * Time: 下午3:27
 */

namespace app\api\validate;


class UpdateBank extends BaseValidate
{

    protected $rule = [
        "customernumber" => "require|length:11",
        "bankCardNumber" => "require",
    ];

    protected $message = [
        'customernumber.require' => '请填写客户编号',
        'customernumber.length' => '客户编号必须为11位',
        'bankCardNumber'  => '银行卡号必须填写',
    ];
}