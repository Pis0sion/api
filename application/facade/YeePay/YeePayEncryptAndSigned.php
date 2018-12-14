<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/7
 * Time: 11:40
 */

namespace app\facade\YeePay;


use think\Facade;

/**
 * @method signed @param $data,$md5Key
 */
class YeePayEncryptAndSigned extends Facade
{

    protected static function getFacadeClass()
    {
        return \app\common\encrypt\YeePayEncryptAndSigned::class;
    }
}