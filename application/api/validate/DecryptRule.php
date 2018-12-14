<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/31
 * Time: 17:01
 */

namespace app\api\validate;


class DecryptRule extends BaseValidate
{
    protected $rule = [
        "url" => "require",
    ];

    protected $message = [
        'url.require' => '请填写加密的url',
    ];
}