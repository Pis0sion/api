<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/26
 * Time: 14:49
 */

namespace app\facade;


use think\Facade;

class Encrypt extends Facade
{

    protected static function getFacadeClass()
    {
        return \app\tools\Encrypt\AesEncrypt::class ;
    }
}