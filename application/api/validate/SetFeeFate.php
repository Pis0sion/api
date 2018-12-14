<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/11/2
 * Time: 14:04
 */

namespace app\api\validate;


class SetFeeFate extends BaseValidate
{
    protected $rule = [
        "customerNumber" => "require|length:11",
        "productType" => "require|max:1",
        "rate" => "require|max:7",

    ];

    protected $message = [
        'customerNumber.require' => '请填写子商户编号',
        'customerNumber.length' => '子商户编号必须为11位',
        'productType.require' => '请选择产品类型',
        'productType.max' => '产品类型最大为1位',
        'rate.require' => '请填费率',
        'rate.max' => '费率设置最大为7位',

    ];
}