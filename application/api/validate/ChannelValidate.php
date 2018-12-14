<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/8
 * Time: 17:59
 */

namespace app\api\validate;


class ChannelValidate extends BaseValidate
{
    protected $rule = [
        "channel"  =>  "require|in:0,1,2,3",
    ];
    protected $message = [
        'channel.require' => '请选择通道',
        'channel.in' => '通道未开通或者不存在',
    ];

}