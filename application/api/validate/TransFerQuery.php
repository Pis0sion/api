<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/24
 * Time: 11:13
 */

namespace app\api\validate;


class TransFerQuery extends BaseValidate
{
    protected $rule = [
        "customerNumber" => "require|length:11",
        "externalNo" => "max:64",
        'pageNo' => 'max:20',
        'serialNo' => 'max:64',
        'transferStatus' => 'max:20',
        'transferWay' => 'require|in:1,2,3',
        "requestDateSectionBegin" => "require|date",
        "requestDateSectionEnd" => "require|date",
    ];
    protected $message = [
        'customerNumber.require' => '请填写子商户编号',
        'customerNumber.length' => '子商户编号长度必须是11位',
        'externalNo.max' => '订单号长度最大为64位',
        'pageNo.require' => '请填写分页参数值',
        'pageNo.max' => '分页参数值最大为20位',
        'serialNo.max' => '结算流水号最大为64位',
        'transferStatus.max' => '结算状态最大为20位',
        'transferWay.require' => '请填写结算方式',
        'transferWay.in' => '请填写正确的结算方式区间值',
        'requestDateSectionBegin.require' => '请填写请求时间：开始时间，时间区间的间隔不能超过 2 天',
        'requestDateSectionBegin.date' => '请求时间格式：yyyy-mm-dd HH:mm:ss',
        'requestDateSectionEnd.require' => '请填写请求时间：结束时间，时间区间的间隔不能超过 2 天',
        'requestDateSectionEnd.date' => '结束时间格式：yyyy-mm-dd HH:mm:ss',
    ];
}