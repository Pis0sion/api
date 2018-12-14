<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/7
 * Time: 10:26
 */

namespace app\api\controller\v1;


use app\api\repositories\PayRepositories;
use app\api\repositories\YeePayRepositories;
use app\api\traits\SetPayChannel;
use think\Controller;

class PayChannelsController extends Controller
{

    use SetPayChannel ;

    protected $beforeActionList = [
        'getAndSetPayChannel',
    ];

    public function __construct(PayRepositories $payRepositories)
    {
        $this->payAction = $payRepositories ;
        parent::__construct();
      //  Hook::listen('checkByIp');
    }

    // 注册   @params
    public function register()
    {
        return $this->payAction->register();
    }
    // 查询用户信息    @param  phoneNum
    public function userInfo()
    {
        return $this->payAction->userInfo();
    }
    // 查询用户余额    @params  customernumber
    public function balance()
    {
        return $this->payAction->userbalance();
    }
    // 查询用户费率    @params  customerNumber  type
    public function queryFee()
    {
        return $this->payAction->queryChannelFee();
    }
    // 设置费率       @params  customerNumber  type  rate
    public function setQueryFee()
    {
        return $this->payAction->setQueryFee();
    }
    // 查询交易记录    @param  requestId
    public function queryOrder()
    {
        return $this->payAction->queryOrder();
    }
    // 结算记录查询    @param
    public function transferQuery()
    {
        return $this->payAction->transferQuery();
    }
    //  修改用户银行卡信息接口
    public function updateBank()
    {
        return $this->payAction->updateBank();
    }
    //  修改用户绑定的手机号邮箱
    public function updateMobile()
    {
        return $this->payAction->updateMobile();
    }
    //  鉴权绑卡查询
    public function queryBindBankRecord()
    {
        return $this->payAction->queryBindBankRecord();
    }

    //绑定或者首付链接获取接口 TODO 目前仅写了绑卡
    public function bindOrPay()
    {
        return $this->payAction->bindOrPay();
    }

    //結算接口
    public function withDrawByCardApi()
    {
        return $this->payAction->withDrawByCardApi();
    }

    //二次支付接口
    public function orderSecondPayApi()
    {
        return $this->payAction->orderSecondPayApi();
    }
    //解密url接口
    public function decryptRule()
    {
        return $this->payAction->decryptRule();
    }

}
