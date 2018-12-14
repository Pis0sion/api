<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/8
 * Time: 14:49
 */

namespace app\api\service\yeepay;


use app\facade\YeePay\YeePayAuthorization;
use app\lib\exception\ParameterException;
use think\facade\Config;

class YeePayRepayment extends YeePayAction
{

    protected $config ;

    const ORDERQUERY = "queryOrderApi.action";

    public function __construct()
    {
        if(Config::has("payChannel.repayment"))
        {
            $this->config = Config::get("payChannel.repayment");
            YeePayAuthorization::instance($this->config);
        }
        else
        {
            throw new ParameterException();
        }
    }


}