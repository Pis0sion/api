<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/8
 * Time: 17:04
 */

namespace app\lib\enum;


class ChannelMode
{

    const CHANNELS = [
        0 => "YeePayCollection" ,           //  收款宝
        1 => "YeePayRepayment" ,            //  便利收
        2 => "YeePayRepaymentThree" ,       //  便利收新增三家
        3 => "jmf" ,                        //  金马付
    ];
}