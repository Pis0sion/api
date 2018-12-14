<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/7
 * Time: 10:08
 */

namespace app\facade\ocr;


use think\Facade;

class Ocr extends Facade
{
    protected static function getFacadeClass()
    {
        return \Godruoyi\OCR\Application::class ;
    }

}