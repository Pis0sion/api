<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/7
 * Time: 11:00
 */

namespace app\facade\http;


use think\Facade;

/**
 * @method get  @param  string $url array  $params
 * @method post @param  string $url array  $params
 * @method upload
 * @method request @param  string $method string $url array  $options
 */
class Guzzle extends Facade
{

    protected static function getFacadeClass()
    {
        return \app\common\tools\Guzzle::class ;
    }
}