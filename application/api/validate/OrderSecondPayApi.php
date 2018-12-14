<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/31
 * Time: 11:19
 */

namespace app\api\validate;


class OrderSecondPayApi extends BaseValidate
{
    protected $rule = [
        "customerNumber" => "require|length:11",
        'requestId' => 'require|max:20',
        "amount" => "require|max:7|between:0.01,5000",
        'ip' => 'require|ip',
        'mcc' => 'require|length:4',
        'cardLastNo' => 'require|isBank|max:20',
        "callBackUrl" => "require|isUrl|max:200",
        "repayPlanNo" => "require|max:20",
        "repayPlanStage" => "require|max:4",
    ];
    protected $message = [
        'customerNumber.require' => '请填写子商户编号',
        'customerNumber.length' => '子商户编号长度必须是11位',
        'requestId.require' => '请填写收款订单号',
        'requestId.length' => '收款订单号长度最大为20位',
        'amount.require' => '请填写收款金额',
        'amount.betwwen' => '收款金额取值范围[0.01,5000]',
        'amount.max' => '收款金额长度最大为7位',
        'ip.require' => '请填写IP地址',
        'ip.ip' => '请填写正确格式的IP地址',
        'mcc.require' => '请填写商品分类编码',
        'mcc.max' => '商品分类编码必须是4位',
        'cardLastNo.require' => '请填写支付卡号',
        'cardLastNo.isBank' => '支付卡号格式不正确',
        'cardLastNo.max' => '支付卡号最大为20位',
        'callBackUrl.require' => '请填写收款成功回调地址',
        'callBackUrl.isUrl' => '收款回调地址格式不正确',
        'callBackUrl.max' => '收款回调地址最大为200位',
        'repayPlanNo.require' => '请填写唯一还款计划编号',
        'repayPlanNo.max' => '还款计划编号最大为20位',
        'repayPlanStage.require' => '请填写唯一还款计划期数',
        'repayPlanStage.max' => '还款计划期数最大为4位',
    ];
}