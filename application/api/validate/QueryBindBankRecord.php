<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/24
 * Time: 14:15
 */

namespace app\api\validate;


class QueryBindBankRecord extends BaseValidate
{
    protected $rule = [
        "customerNumber" => "require|length:11",
        "requestId" => "max:20",
        "createTimeBegin" => "require|date|max:19",
        "createTimeEnd" => "require|date|max:19",
        "pageNo" => "max:20|number",
        "status" => "max:20",
    ];
    protected $message = [
        'customerNumber.require' => '请填写子商户编号',
        'customerNumber.length' => '子商户编号长度必须是11位',
        'requestId.max' => '鉴权绑卡的请求号长度最大为20位',
        'createTimeBegin.require' => '请填写绑卡请求时间：开始时间，时间区间的间隔不能超过 30 天',
        'createTimeBegin.date' => '绑卡请求开始时间格式：yyyy-mm-dd HH:mm:ss',
        'createTimeBegin.max' => '绑卡请求开始时间长度最大为19位',
        'createTimeEnd.require' => '请填写绑卡请求时间：结束时间，时间区间的间隔不能超过 30 天',
        'createTimeEnd.date' => '绑卡请求结束时间格式：yyyy-mm-dd HH:mm:ss',
        'createTimeEnd.max' => '绑卡请求结束时间长度最大为19位',
        'pageNo.number' => '分页参数值必须为正整数',
        'pageNo.max' => '分页参数值最大为20位',
        'status.max' => '订单状态值最大为20位',
    ];

}