<?php
/**
 * Created by PhpStorm.
 * User: pis0sion
 * Date: 18-10-16
 * Time: 上午9:04
 */

namespace app\api\validate;


class IdCardBack extends BaseValidate
{
    protected $rule = [
        "uid" => "require",
    ];

    protected $message = [
        'uid.require' => '请填写uid',
    ];

}