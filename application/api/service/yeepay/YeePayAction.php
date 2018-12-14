<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/8
 * Time: 14:07
 */

namespace app\api\service\yeepay;


use app\api\factory\PayAction;
use app\api\validate\CustomerNoValidate;
use app\api\validate\DecryptRule;
use app\api\validate\MobileValidate;
use app\api\validate\OrderSecondPayApi;
use app\api\validate\QueryBindBankRecord;
use app\api\validate\QueryFee;
use app\api\validate\ReceiveApi;
use app\api\validate\RegisterValidate;
use app\api\validate\TransFerQuery;
use app\common\tools\Utils;
use app\facade\YeePay\YeePayAuthorization;
use app\lib\exception\ParameterException;
use GuzzleHttp\Exception\TransferException;
use app\api\validate\BindOrPay;
use app\api\validate\WithDrawByCardApi;
use think\facade\Hook;
use app\api\validate\SetFeeFate;
use app\api\validate\UserBalance;

abstract class YeePayAction implements PayAction
{

    const REGISTER               = 'register.action';
    const CUSTOMER_INFO          = 'customerInforQuery.action';
    const USERBALANCE            = 'customerBalanceQuery.action';
    const QUERYFEE               = 'queryFeeSetApi.action' ;
    const SETFEEFATE             = 'feeSetApi.action' ;
    const DRAW                   = 'withDrawApi.action';
    const TRANSFERQUERY          = 'transferQuery.action';
    const QUERYORDER             = 'queryOrderApi.action';
    const QUERYBINDBANKRECORD    = 'queryBindBankRecord.action';
    const BINDORPAY              = 'bindOrPay.action';
    const INFORUPDATE            = 'customerInforUpdate.action' ;
    const WITHDRAWBYCARDAPI      = 'withDrawByCardApi.action';
    const ORDERSECONDPAYAPI      = 'orderSecondPayApi.action';


    public function register()
    {
        // TODO: Implement register() method.
        (new RegisterValidate())->goCheck();
        $userinfo = request()->param();
        Hook::listen("file_upload",$userinfo['idCard']);
        $data = [
            'mainCustomerNumber'=> "" ,
            'requestId'=>(string) $userinfo['requestId'],
            'customerType'=>'PERSON',
            'bindMobile'=>(string) $userinfo['bindMobile'],
            'signedName'=>$userinfo['signedName'],
            'linkMan'=>$userinfo['linkMan'],
            'idCard'=>$userinfo['idCard'],
            'legalPerson'=>$userinfo['legalPerson'],
            'minSettleAmount'=>(string) '100',
            'riskReserveDay'=>(string) '0',
            'bankAccountNumber'=>$userinfo['bankAccountNumber'],
            'bankName'=>(string) $userinfo['bankName'],
            'accountName'=>(string) $userinfo['accountName'],
            'areaCode'=>(string) 10000,
            'certFee'=>(string) '0',
            'manualSettle'=>'Y' ,
            'bankCardPhoto'=> new \CURLFile("./uploads/".$userinfo['idCard']."/".$userinfo['idCard']."-bankCardPhoto.jpeg","image/jpeg","bankCardPhoto.jpeg"),
            'idCardPhoto'=> new \CURLFile("./uploads/".$userinfo['idCard']."/".$userinfo['idCard']."-idCardPhoto.jpeg","image/jpeg","idCardPhoto.jpeg"),
            'idCardBackPhoto'=> new \CURLFile("./uploads/".$userinfo['idCard']."/".$userinfo['idCard']."-idCardBackPhoto.jpeg","image/jpeg","idCardBackPhoto.jpeg"),
            'personPhoto'=> new \CURLFile("./uploads/".$userinfo['idCard']."/".$userinfo['idCard']."-personPhoto.jpeg","image/jpeg","personPhoto.jpeg"),
         ];
        return YeePayAuthorization::payRequest(static::REGISTER , $data , 'reg');
    }

    public function draw()
    {
        // TODO: Implement draw() method.
    }

    public function userbalance()
    {
        // TODO: Implement userbalance() method.
        (new UserBalance())->goCheck();
        $params = request()->only(['customerNumber','balanceType']);
        extract($params);
        $data = [
            'mainCustomerNumber'=> "" ,
            'customerNumber'=>(string) $customerNumber,
            'balanceType'=>(string)$balanceType,
        ];

        return YeePayAuthorization::payRequest(static::USERBALANCE,$data);
    }

    public function info()
    {
        // TODO: Implement info() method.
        (new MobileValidate())->goCheck();
        $mobilePhone = request()->param('mobilePhone');

        $data = [
            'mainCustomerNumber'=> "" ,
            'mobilePhone' =>(string) $mobilePhone
        ];
        return YeePayAuthorization::payRequest(static::CUSTOMER_INFO,$data);
    }

    public function queryFee()
    {
        // TODO: Implement queryFee() method.
        (new QueryFee())->goCheck();
        $params = request()->only(['customerNumber','productType']);
        extract($params);
        $data= [
            'customerNumber'=>$customerNumber, #子商户编号
            'mainCustomerNumber'=> "" ,
            'productType'=>(string)$productType, #整数类型, 1.交易 2.提现 3.日结通基 本 4.日结通额外 5.日结通非工作日 6.微信
        ] ;
        return YeePayAuthorization::payRequest(static::QUERYFEE,$data);
    }

    public function setFeeFate()
    {
        // TODO: Implement setFeeFate() method.
        (new SetFeeFate())->goCheck();
        $params = request()->only(['customerNumber','productType','rate']);
        extract($params);
        $data = [
            'customerNumber'=>$customerNumber , #子商户编号
            'mainCustomerNumber'=> "" ,
            'productType'=>(string)$productType , #整数类型, 1.交易 2.提现 3.日结通基 本 4.日结通额外 5.日结通非工作日 6.微信
            'rate'=>(string)$rate ,
        ];
        return YeePayAuthorization::payRequest(static::SETFEEFATE,$data);

    }

    public function queryOrder()
    {
        // TODO: Implement queryOrder() method.
 //       (new QueryOrder())->goCheck();
        $params = request()->param("","","strval");
        $data = [
            'mainCustomerNumber'  => '' ,
            'customerNumber'      => $params['customerNumber'] ?? "" ,
            'requestId'           => $params['requestId'] ?? "" ,
            'createTimeBegin'      => $params['createTimeBegin'] ?? "",
            'createTimeEnd'      => $params['createTimeEnd'] ?? "" ,
            'payTimeBegin'      =>  $params['payTimeBegin'] ?? "" ,
            'payTimeEnd'      =>  $params['payTimeEnd'] ?? "" ,
            'lastUpdateTimeBegin'      => $params['lastUpdateTimeBegin'] ?? "" ,
            'lastUpdateTimeEnd'      =>  $params['lastUpdateTimeEnd'] ?? "",
            'status'      => $status ?? "" ,
            'busiType'      => '' ,
            'pageNo'      =>  $params['pageNo'] ?? "1" ,
        ];
        return YeePayAuthorization::payRequest(static::QUERYORDER,$data);
    }

    public function transferQuery()
    {
        // TODO: Implement transferQuery() method.
        (new TransFerQuery())->goCheck();
        $params = request()->param("",null,'strval');
        extract($params);
        $data = [
            'customerNumber' => $customerNumber,
            'externalNo' => $externalNo ?? "",
            'mainCustomerNumber' => '',
            'pageNo' => $pageNo ?? "1",
            'requestDateSectionBegin' => $requestDateSectionBegin,
            'requestDateSectionEnd' => $requestDateSectionEnd,
            'serialNo' => $serialNo ?? "",
            'transferStatus' => $transferStatus ?? "",
            'transferWay' => $transferWay,
        ];
        return YeePayAuthorization::payRequest(static::TRANSFERQUERY,$data);
    }

    public function updateBank()
    {
        // TODO: Implement updateBank() method.
        (new CustomerNoValidate())->goCheck();
        $params = request()->only(['customerNumber','bankCardNumber','bankName']);
        $data = [
            'mainCustomerNumber' => "",
            'customerNumber'=> (string)$params['customerNumber'],
            'bankCardNumber'=> $params['bankCardNumber'] ?? "",
            'bankName'=> $params['bankName'] ?? "",
        ];
        return YeePayAuthorization::payRequest(static::INFORUPDATE,$data,"updateBank");
    }

    public function updateMobile()
    {
        // TODO: Implement updateMobile() method.
        (new CustomerNoValidate())->goCheck();
        $params = request()->only(['customerNumber','bindMobile','areaCode','mailStr']);
        $data = [
            'mainCustomerNumber' => "",
            'customerNumber'=> (string)$params['customerNumber'],
            'bindMobile'=> $params['bindMobile'] ?? "",
            'areaCode'=> $params['areaCode'] ?? "",
            'mailStr'=> $params['mailStr'] ?? "",
        ];
        return YeePayAuthorization::payRequest(static::INFORUPDATE,$data,"updateBaseInfo");
    }

    public function updateDraw()
    {
        // TODO: Implement updateDraw() method.
        (new CustomerNoValidate())->goCheck();
        $params = request()->only(['customerNumber','riskReserveDay','manualSettle']);
        $data = [
            'mainCustomerNumber' => "",
            'customerNumber'=> (string)$params['customerNumber'],
            'riskReserveDay'=> $params['riskReserveDay'] ?? "",
            'manualSettle'=> $params['manualSettle'] ?? "",
        ];
        return YeePayAuthorization::payRequest(static::INFORUPDATE,$data,"updateDraw");
    }

    public function queryBindBankRecord()
    {
        // TODO: Implement queryBindBankRecord() method.
        (new QueryBindBankRecord())->goCheck();
        $params = request()->param("",null,'strval');
        extract($params);
        $data = [
            'mainCustomerNumber' => '',
            'customerNumber' => $customerNumber ?? "",
            'requestId' => $requestId ?? "",
            'createTimeBegin' => $createTimeBegin,
            'createTimeEnd' => $createTimeEnd,
            'pageNo' => $pageNo ?? "1",
            'status' => $status ?? "",
        ];
        return YeePayAuthorization::payRequest(static::QUERYBINDBANKRECORD,$data);
    }

    public function bindOrPay()
    {
        // TODO: Implement bindOrPay() method.
        if(request()->param('channel') == 0)
            throw new ParameterException(['msg'=>'绑定接口不支持此通道']);
        (new BindOrPay())->goCheck();
        $params = request()->param("",null,'strval');
        extract($params);
        $data = [
            'amount' => (string)0,
            'bankCardNo' => $bankCardNo,
            'bindMobile' => $bindMobile,
            'callbackUrl' => $callbackUrl,
            'customerNumber' => $customerNumber,
            'mainCustomerNumber' => '',
            'ip' => $ip ?? "",
            'mcc' => "",
            'productName' => "",
            'repayPlanNo' => "",
            'repayPlanStage' => "",
            'src' => "",
            'requestId' => $requestId,
        ];
        return YeePayAuthorization::payRequest(static::BINDORPAY,$data);
    }

    public function withDrawByCardApi()
    {
        // TODO: Implement withDrawByCardApi() method.
        (new WithDrawByCardApi())->goCheck();
        $params = request()->param("",null,'strval');
        extract($params);
        $data['amount'] = $amount;
        if($channel == 1)
            $data['bankAccountNum'] = $bankAccountNum ?? "";
        $data['customerNumber'] = $customerNumber;
        $data['externalNo'] = $externalNo;
        $data['mainCustomerNumber'] = '';
        $data['transferWay'] = $transferWay;
        if($channel == 1)
            $data['salesProduct'] = $salesProduct ?? "SKBRJT";
        $data['callBackUrl'] = $callBackUrl ?? "";
        return YeePayAuthorization::payRequest(static::WITHDRAWBYCARDAPI,$data);
    }

    public function orderSecondPayApi()
    {
        // TODO: Implement orderSecondPayApi() method.
        if(request()->param('channel') == 0){
            (new ReceiveApi())->goCheck();
        }else{
            (new OrderSecondPayApi())->goCheck();
        }
        $params = request()->param("",null,'strval');
        extract($params);
        if(request()->param('channel') == 0){
            $data['source'] = "B";
            $data['mainCustomerNumber'] = "";
            $data['customerNumber'] = $customerNumber;
            $data['amount'] = $amount;
            $data['mcc'] = $mcc;
            $data['requestId'] = $requestId ?? "";
            $data['callBackUrl'] = $callBackUrl;
            $data['webCallBackUrl'] = $webCallBackUrl;
            $data['payerBankAccountNo'] = $payerBankAccountNo ?? "";
            $data['autoWithdraw'] = $autoWithdraw ?? "";
            $data['withdrawCardNo'] = $withdrawCardNo ?? "";
            $data['withdrawCallBackUrl'] = $withdrawCardNo ?? "";
        }else{
            $data['mainCustomerNumber'] = "";
            $data['customerNumber'] = $customerNumber;
            $data['requestId'] = $requestId;
            $data['amount'] = $amount;
            $data['ip'] = $ip;
            $data['mcc'] = $mcc;
            $data['src'] = "B";
            $data['cardLastNo'] = $cardLastNo;
            $data['callBackUrl'] = $callBackUrl;
            $data['productName'] = "NetWork Products";
            $data['repayPlanNo'] = $repayPlanNo;
            $data['repayPlanStage'] = $repayPlanStage;
        }
        return YeePayAuthorization::payRequest(static::ORDERSECONDPAYAPI,$data);
    }

    public function decryptRule()
    {
        (new DecryptRule())->goCheck();
        $params = request()->param("",null,'strval');
        extract($params);
        return YeePayAuthorization::decrypt($url);
    }


}