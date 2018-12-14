<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/8
 * Time: 9:57
 */

namespace app\facade\YeePay;


use think\Facade;

class YeePayAuthorization extends Facade
{

    protected static function getFacadeClass()
    {
        return \app\api\service\yeepay\Authorization::class ;
    }
}