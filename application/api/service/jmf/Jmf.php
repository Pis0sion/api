<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/7
 * Time: 16:28
 */
namespace app\api\service\jmf;


use app\api\factory\PayAction;

class Jmf implements PayAction
{



    public function draw($customerNumber = '', $amount = 0, $externalNo = "", $transferWay = '1')
    {
        // TODO: Implement draw() method.
        return "jinmafu";
    }
    public function info($mobilePhone = "")
    {
        // TODO: Implement info() method.
        return "jinmafu";
    }
    public function queryFee($customerNumber = '', $type = '')
    {
        // TODO: Implement queryFee() method.
        return "jinmafu";
    }
    public function setFeeFate($customerNumber = '', $type = '', $rate = '')
    {
        // TODO: Implement setFeeFate() method.
        return "jinmafu";
    }
}