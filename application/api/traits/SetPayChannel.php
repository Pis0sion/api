<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/8
 * Time: 17:12
 */

namespace app\api\traits;


use app\api\validate\ChannelValidate;
use app\lib\enum\ChannelMode;
use app\lib\exception\ParameterException;

trait SetPayChannel
{

    protected $payAction ;


    protected function getAndSetPayChannel()
    {
        (new ChannelValidate())->goCheck();
        $channel = request()->param("channel");
        if(!empty($channel)||($channel === '0'))
        {
            $this->payAction->setPayChannel(ChannelMode::CHANNELS[$channel]);
        }
        else
        {
            throw new ParameterException();
        }
    }
}