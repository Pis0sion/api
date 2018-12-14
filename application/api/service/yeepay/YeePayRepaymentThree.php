<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/8
 * Time: 15:00
 */

namespace app\api\service\yeepay;

use app\facade\YeePay\YeePayAuthorization;
use app\lib\exception\ParameterException;
use think\facade\Config;

class YeePayRepaymentThree extends YeePayAction
{
    protected $config ;

    const ORDERQUERY = "queryOrderApi.action";

    public function __construct()
    {
        if(Config::has("payChannel.repaymentThree"))
        {
            $this->config = Config::get("payChannel.repaymentThree");
            YeePayAuthorization::instance($this->config);
        }
        else
        {
            throw new ParameterException();
        }
    }

}