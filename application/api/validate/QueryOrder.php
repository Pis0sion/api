<?php
/**
 * Created by PhpStorm.
 * User: pis0sion
 * Date: 18-10-24
 * Time: 上午10:47
 */

namespace app\api\validate;


class QueryOrder extends BaseValidate
{
    protected $rule = [
        "requestId" => "require",
    ];

    protected $message = [
        'requestId.require' => '请填写requestId',
    ];
}