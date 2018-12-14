<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/11/3
 * Time: 10:44
 */

namespace app\api\validate;


class UserBalance extends BaseValidate
{
    protected $rule = [
        "customerNumber" => "require|length:11",
        "balanceType" => "require|max:1",

    ];

    protected $message = [
        'customerNumber.require' => '请填写子商户编号',
        'customerNumber.length' => '子商户编号必须为11位',
        'balanceType.require' => '请填写可用余额类型',
        'balanceType.max' => '可用余额类型最大为1位',
    ];
}