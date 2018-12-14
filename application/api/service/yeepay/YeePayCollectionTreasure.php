<?php
namespace app\api\service\yeepay;

use app\facade\YeePay\YeePayAuthorization;
use app\lib\exception\ParameterException;
use think\facade\Config;

/**
 *  shou kuan bao
 */
class YeePayCollectionTreasure extends YeePayAction
{

    protected $config ;

    const QUERYORDER = "tradeReviceQuery.action" ;
    const WITHDRAWBYCARDAPI = "withDrawApi.action";
    const ORDERSECONDPAYAPI      = 'receiveApi.action';

    public function __construct()
    {
        if(Config::has("payChannel.collection"))
        {
            $this->config = Config::get("payChannel.collection");
            YeePayAuthorization::instance($this->config);
        }
        else
        {
           throw new ParameterException();
        }
    }

}