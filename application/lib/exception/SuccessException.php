<?php
/**
 * Created by PhpStorm.
 * User: 麻婆伦意识
 * Date: 2018/10/25
 * Time: 23:53
 */

namespace app\lib\exception;


class SuccessException extends BaseException
{
    public $code = 201;
    public $msg = '操作成功';
    public $errorCode = 10000;
    public $pointUrl = "";
}