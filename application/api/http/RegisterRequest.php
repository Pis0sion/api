<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/9
 * Time: 14:12
 */

namespace app\api\http;


use app\api\validate\RegisterValidate;
use think\Request;

class RegisterRequest extends Request
{

    public function __invoke()
    {
        (new RegisterValidate())->goCheck();
        $params = $this->only([
            'bindMobile','signedName','linkMan',
            'idCard','legalPerson','bankAccountNumber',
            'bankName','accountName','areaCode'
        ]);

        return $params ;
    }
}