<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/25
 * Time: 9:23
 */

namespace app\api\validate;


class WithDrawByCardApi extends BaseValidate
{
    protected $rule = [
        "customerNumber" => "require|length:11",
        "amount" => "require|max:7|between:0.01,1000000",
        'bankAccountNum' => 'isBank|max:20',
        'externalNo' => 'require|max:64',
        'transferWay' => 'require|in:1,2',
        "callBackUrl" => "isUrl|max:200",
        "salesProduct" => "max:10|in:SKBDHT,SKBRJT",
    ];
    protected $message = [
        'customerNumber.require' => '请填写子商户编号',
        'customerNumber.length' => '子商户编号长度必须是11位',
        'amount.require' => '请填写结算金额',
        'amount.betwwen' => '结算金额取值范围[0.01,1000000]',
        'amount.max' => '结算金额长度最大为7位',
        'bankAccountNum.isBank' => '银行卡号格式不正确',
        'bankAccountNum.max' => '结算银行最大为20位',
        'externalNo.require' => '请填写结算唯一请求号',
        'externalNo.max' => '结算请求号最大为64位',
        'transferWay.require' => '请填写结算方式',
        'transferWay.in' => '请填写正确的结算方式区间值',
        'callBackUrl.isUrl' => '结算回调地址格式不正确',
        'callBackUrl.max' => '结算回调地址最大为200位',
        'salesProduct.max' => '营销产品最大为10位',
        'salesProduct.in' => '营销产品取值不正确',
    ];
}