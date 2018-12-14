<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/27
 * Time: 11:18
 */

namespace app\grant\validate;


use app\api\validate\BaseValidate;

class ProductValidate extends BaseValidate
{
    protected $rule = [
        "product_name" => "require",
        "product_value" => 'require|number',
    ];

    protected $message = [
        'product_name.require' => '请填写产品名称',
        'product_value.require' => '请填写产品值',
        'product_value.number' => '产品值格式为数字',
    ];
}