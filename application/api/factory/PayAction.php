<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/7
 * Time: 16:22
 */

namespace app\api\factory;


use app\api\http\RegisterRequest;
use think\Request;

interface PayAction
{
    /**
     * 出款接口
     * @param string $customerNumber 子商户编号
     * @param number $amount 出款金额
     * @param string $externalNo 出款流水号
     * @param string $transferWay 出款方式:1|日结通,2|委托结算
     */
    public function draw();

    /**
     * 子商户信息查询
     * @param string $mobilePhone 子商户手机号码
     */

    public function info();

    /**
     * 费率设置
     * @param string $customerNumber
     * @param string $type
     * @param string $rate
     * @return mixed
     */
    public function setFeeFate();

    /**
     * 费率查询
     * @param string $customerNumber
     * @param number $type
     */
    public function queryFee();

    /**
     * 费用余额
     * @param string $customernumber
     * @param int $type
     * @return mixed
     */
    public function userbalance() ;

    /**
     * 用户注册
     * @return mixed
     */
    public function register();

    /**
     * 交易查询
     */

    public function queryOrder();

    /**
     * 结算记录查询
     */
    public function transferQuery();

    /**
     * 鉴权绑卡记录查询接口
     */
    public function queryBindBankRecord();

    /**
     * 绑卡或者首付链接获取接口
     */
    public function bindOrPay();

    /**
     * 修改用户绑定的手机号
     */
    public function updateMobile();

    /**
     * 修改用户绑定的银行卡
     */
    public function updateBank();

    /**
     * 修改用户结算信息
     */
    public function updateDraw();


    /**
     * 結算接口
     */
    public function withDrawByCardApi();

    /**
     * 二次支付接口
     */
    public function orderSecondPayApi();

    /**
     * 解密url
     */
    public function decryptRule();
}