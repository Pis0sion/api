<?php
/**
 * Created by PhpStorm.
 * User: pis0sion
 * Date: 18-10-25
 * Time: 上午11:03
 */

namespace app\api\behavior;


use app\grant\model\CustomerInfoModel;
use app\grant\model\GrantModel;
use app\grant\model\ProductListModel;
use app\lib\exception\ForbiddenException;
use app\lib\exception\ParameterException;


class CheckLegalByIp
{
    public $overcome = [
        "api"
    ];

    public function run($params)
    {
        $module = $this->getModuleName();
        if(in_array($module,$this->overcome))
        {
            $this->checkIsNotLegal();
        }
    }

    private function getModuleName()
    {
        return request()->module();
    }

    private function checkIsNotLegal()
    {

        // 判断用户ip绑定的通道是否合法
        //  TODO: 通过ip 查询该ip下绑定的通道
        $isLegal = $this->check();

        if(!$isLegal)
        {
            throw new ForbiddenException([
                'msg'  =>  '该用户并未开通此通道' ,
            ]);
        }
    }

    //TODO 可增加扩展，列如针对产品授权日期，针对产品每自然月授权次数，等~~~~~~  好闲~~~~
    private function check()
    {

        extract(request()->param());
        $ip = request()->ip(0,true);
        $ip = '101.132.172.189';
        $productList = ProductListModel::where('product_value',$channel)->find();
        if(empty($productList))
            throw new ParameterException(['msg'=>'产品方没上架该产品','errorCode'=>'10050']);
        if($productList['product_status'] == 2)
            throw new ParameterException(['msg'=>'该产品通道已关闭','errorCode'=>'10046']);
        if($productList['recycle'] == 2)
            throw new ParameterException(['msg'=>'该产品通道已下架','errorCode'=>'10047']);
        $grantIP = GrantModel::where('ip',$ip)->where('product_id',$productList['id'])->find();
        if(empty($grantIP))
            throw new ParameterException(['msg'=>'无权访问此产品','errorCode'=>'10041']);
        if($grantIP['is_activation'] == 2)
            throw new ParameterException(['msg'=>'该设备访问此通道产品权限已关闭','errorCode'=>'10042']);
        if($grantIP['recycle'] == 2)
            throw new ParameterException(['msg'=>'该设备访问此通道产品已下架','errorCode'=>'10043']);
        $customerList = $this->checkCustomer($grantIP['id']);
        if($customerList['is_activation'] == 2)
            throw new ParameterException(['msg'=>'该设备注册企业通道权限已关闭','errorCode'=>'10044']);
        if($customerList['recycle'] == 2)
            throw new ParameterException(['msg'=>'该设备注册企业通道产品已下架','errorCode'=>'10045']);
        if($grantIP['authorization_time'] <= sp_datetime())
            throw new ParameterException(['msg'=>'此IP设备授权日期已过期，如有需要请联系客服','errorCode'=>'10048']);
        if($grantIP['call_numbers'] != "-1" && $grantIP['call_numbers'] == 0)
            throw new ParameterException(['msg'=>'接口调用次数用完，请联系客服','errorCode'=>'10049']);
        return true;
    }

    private function checkCustomer($gid)
    {
        $result = [];
        $customerInfo = CustomerInfoModel::Field(['is_activation','recycle','grant_ids'])->all();
        foreach ($customerInfo as $key=>$value)
        {
            $flag = preg_match('/'.$gid.'/',$value['grant_ids'],$mth);
            if($flag)
            {
                $result = $value;
            }
        }
        return $result;
    }
}