<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/9
 * Time: 14:12
 */

namespace app\api\http;


use app\api\validate\QueryOrderValidate;
use think\Request;

class QueryOrderRequest extends Request
{

    public function __invoke()
    {
        (new QueryOrderValidate())->goCheck();
        $params = $this->only([
            'requestId'
        ]);

        return $params ;
    }
}