<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/25
 * Time: 17:12
 */

namespace app\grant\request;


use app\grant\validate\LoginValidate;

class LoginRequest
{

    public function doAction()
    {
        (new LoginValidate())->goCheck();
        return app("loginToken")->checkToken();
    }
}