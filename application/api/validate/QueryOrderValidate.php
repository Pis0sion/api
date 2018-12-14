<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/8
 * Time: 16:02
 */

namespace app\api\validate;


class QueryOrderValidate extends BaseValidate
{
    protected $rule = [
        "requestId" => "require|max:30",
    ];

    protected $message = [
        'requestId.require' => '请填收款订单号',
        'requestId.max' => '收款订单号限制长度30字节',
    ];

}