<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/9
 * Time: 16:07
 */

namespace app\api\validate;


class QueryFee extends BaseValidate
{

    protected $rule = [
        "customerNumber" => "require|length:11",
        "productType" => "require|max:1",
    ];
    protected $message = [
        'customerNumber.require' => '请填写子商户编号',
        'customerNumber.length' => '子商户编号长度必须是11位',
        'productType.require' => '请选择产品类型',
        'productType.max' => '产品类型最大为1位',
    ];
}