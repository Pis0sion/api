<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/31
 * Time: 11:47
 */

namespace app\api\validate;


class ReceiveApi extends BaseValidate
{
    protected $rule = [
        "customerNumber" => "require|length:11",
        "amount" => "require|max:7|between:0.01,100000",
        'mcc' => 'require|length:4',
        'requestId' => 'max:30',
        "callBackUrl" => "require|isUrl|max:200",
        'webCallBackUrl' => 'require|isUrl|max:200',
        'payerBankAccountNo' => 'isBank|max:20',
        "autoWithdraw" => "in:true,false",
        "withdrawCardNo" => "max:20",
        "withdrawCallBackUrl" => "isUrl|max:200",
    ];
    protected $message = [
        'customerNumber.require' => '请填写子商户编号',
        'customerNumber.length' => '子商户编号长度必须是11位',
        'amount.require' => '请填写收款金额',
        'amount.betwwen' => '收款金额取值范围[0.01,100000]',
        'amount.max' => '收款金额长度最大为7位',
        'mcc.require' => '请填写商品分类编码',
        'mcc.length' => '商品分类编码必须是4位',
        'requestId.length' => '收款订单号长度最大为30位',
        'callBackUrl.require' => '请填写收款成功回调地址',
        'callBackUrl.isUrl' => '收款成功回调地址格式不正确',
        'callBackUrl.max' => '收款成功回调地址最大为200位',
        'webCallBackUrl.require' => '请填写支付成功重定向页面地址',
        'webCallBackUrl.isUrl' => '支付成功重定向页面地址格式不正确',
        'webCallBackUrl.max' => '支付成功重定向页面地址最大为200位',
        'payerBankAccountNo.isBank' => '支付卡号格式不正确',
        'payerBankAccountNo.max' => '支付卡号最大为20位',
        'autoWithdraw.in' => '逐笔结算格式不正确',
        'withdrawCardNo.max' => '提现卡号最大为20位',
        'withdrawCallBackUrl.isUrl' => '逐笔结算回调地址格式不正确',
        'withdrawCallBackUrl.max' => '逐笔结算回调地址最大为20位',
    ];
}