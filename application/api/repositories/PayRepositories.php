<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/7
 * Time: 15:54
 */

namespace app\api\repositories;

use app\api\service\PayChannelsProxy;


class PayRepositories
{
    protected $payChannel ;

    public function setPayChannel($action)
    {
        return $this->payChannel = PayChannelsProxy::$action();
    }

    public function register()
    {
        return $this->payChannel->register();
    }

    public function userbalance()
    {
        return $this->payChannel->userbalance();
    }

    public function userInfo()
    {
        return $this->payChannel->info();
    }

    public function queryChannelFee()
    {
        return $this->payChannel->queryFee();
    }

    public function setQueryFee()
    {
        return $this->payChannel->setFeeFate();
    }

    public function queryOrder()
    {
        return $this->payChannel->queryOrder();
    }

    public function transferQuery()
    {
        return $this->payChannel->transferQuery();
    }

    public function updateBank()
    {
        return $this->payChannel->updateBank();
    }

    public function updateMobile()
    {
        return $this->payChannel->updateMobile();
    }

    public function queryBindBankRecord()
    {
        return $this->payChannel->queryBindBankRecord();
    }

    public function bindOrPay()
    {
        return $this->payChannel->bindOrPay();
    }

    public function withDrawByCardApi()
    {
        return $this->payChannel->withDrawByCardApi();
    }

    public function orderSecondPayApi()
    {
        return $this->payChannel->orderSecondPayApi();
    }

    public function decryptRule()
    {
        return $this->payChannel->decryptRule();
    }
}