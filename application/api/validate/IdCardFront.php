<?php
/**
 * Created by PhpStorm.
 * User: pis0sion
 * Date: 18-10-15
 * Time: 下午2:16
 */

namespace app\api\validate;


class IdCardFront extends BaseValidate
{
    protected $rule = [
        "uid" => "require",
    ];

    protected $message = [
        'uid.require' => '请填写uid',
    ];
}