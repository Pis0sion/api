<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/10
 * Time: 16:32
 */

namespace app\facade\qiniu;


use think\Facade;

class Qiniu extends Facade
{

    protected static function getFacadeClass()
    {
        return \gmars\qiniu\Qiniu::class ;
    }

}