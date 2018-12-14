<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/7
 * Time: 16:20
 */

namespace app\api\service;


use app\api\service\yeepay\YeePay;

interface Fatory
{
    public static function getinstance();
}


/**
 * @classFlag : jmf  YeePayCollection  YeePayRepayment  YeePayRepaymentThree
 * @package app\api\service
 */
class PayChannelsProxy
{
    public static function switchPayChannel($classFlag)
    {
        return app($classFlag)::getInstance();
    }

    public static function __callStatic($name, $arguments)
    {
        // TODO: Implement __callStatic method.
        $params = $name."Factor";
        return call_user_func([self::class,"switchPayChannel"],$params);
    }
}

/**
 * Class YeePayCollectionFactory
 * @package app\api\service
 */
class YeePayCollectionFactory implements Fatory
{
    public static function getinstance()
    {
        // TODO: Implement getinstance() method.
        return app("YeePayCollectionTreasure");
    }
}

/**
 * Class YeePayRepaymentFactory
 * @package app\api\service
 */
class YeePayRepaymentFactory implements Fatory
{
    public static function getinstance()
    {
        // TODO: Implement getinstance() method.
        return app("YeePayRepayment");
    }
}

/**
 * Class YeePayRepaymentThreeFactory
 * @package app\api\service
 */
class YeePayRepaymentThreeFactory implements Fatory
{
    public static function getinstance()
    {
        // TODO: Implement getinstance() method.
        return app("YeePayRepaymentThree");
    }
}



