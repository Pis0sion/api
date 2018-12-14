<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/26
 * Time: 17:09
 */

namespace app\grant\service;


use app\grant\model\GrantModel;
use app\grant\model\CustomerInfoModel;
use app\grant\model\ProductListModel;
use app\lib\exception\ParameterException;
use app\lib\exception\SuccessException;

class GrantService
{
    public function getGrantList()
    {
        extract(request()->param());
        if(!isset($ids))
            return true;
        $ids = explode(',',$ids);
        $list = $this->getGrantData($ids);
        return $list;
    }

    public function getProductList()
    {
        $list = ProductListModel::Field(['id','product_name'])->where('recycle','1')->where('product_status',1)->all();
        return $list;
    }

    public function getCustomerList($flag)
    {
        if($flag)
        {
            $list = CustomerInfoModel::Field(['id','customer_name'])->where('recycle','1')->where('is_activation',1)->all();
        }else{
            $list = CustomerInfoModel::Order('id','desc')->where('recycle','1')->paginate(Config('config.page'));
        }
        return $list;
    }

    public function grantAdd()
    {
        extract(request()->param());
        $grantModel = new GrantModel;
        $flag = $grantModel->where('ip',$ip)->where('product_id',$product_id)->find();
        if($flag)
            throw new ParameterException(['msg'=>"此IP已开通所选产品"]);
        $is_activation = 1;
        $createtime = sp_datetime();
        $operator = session('userInfo.username');
        $data = compact('ip','product_id','is_activation','createtime','operator','authorization_time','call_numbers');
        $result = $grantModel->save($data);
        if(!$result)
            throw new ParameterException(['msg'=>"响应错误，联系技术人员"]);
        $this->saveGrantIds($customer_id,$grantModel->id);
        throw new SuccessException(['msg'=>"授权成功"]);
    }

    public function customerInfoAdd()
    {
        extract(request()->param());
        $customerInfoModel = new CustomerInfoModel;
        $flag = $customerInfoModel->where('customer_name',$customer_name)->find();
        if($flag)
            throw new ParameterException(['msg'=>"此公司/平台已开通授权"]);
        $is_activation = 1;
        $createtime = sp_datetime();
        $operator = session('userInfo.username');
        $data = compact('createtime','customer_name','is_activation','operator');
        $result = $customerInfoModel->save($data);
        if(!$result)
            throw new ParameterException(['msg'=>"响应错误，联系技术人员"]);
        throw new SuccessException(['msg'=>"授权成功"]);
    }

    public function grantStatus()
    {
        extract(request()->param());
         GrantModel::update(['is_activation' => $datas['product_status']],['id'=>$id]);
        throw new SuccessException(['msg'=>"更新成功"]);
    }

    public function customerStatus()
    {
        extract(request()->param());
        CustomerInfoModel::update(['is_activation' => $datas['product_status']],['id'=>$id]);
        throw new SuccessException(['msg'=>"更新成功"]);
    }

    protected function saveGrantIds($customer_id,$grantId)
    {
        $grant_ids = CustomerInfoModel::where("id",$customer_id)->value('grant_ids');
        if(empty($grant_ids))
        {
            $result = CustomerInfoModel::where("id",$customer_id)->update(['grant_ids'=>$grantId]);
        }
        else{
            $ids = explode(',',$grant_ids);
            $ids[] = $grantId;
            $grant_ids = implode(',',$ids);
            $result = CustomerInfoModel::where("id",$customer_id)->update(['grant_ids'=>$grant_ids]);
        }
        if(!$result)
            throw new ParameterException(['msg'=>"响应错误，联系技术人员"]);
        return true;
    }

    /**
     * 获取此平台辖下IP集合数据返回接受的list函数
     * @Author：麻破伦意识
     * @DateTime：2018/10/29
     * @param $ids
     */
    protected function getGrantData($ids)
    {
       $result =  GrantModel::with('productList')->where('id','in',$ids)->where('recycle','1')->order('id','desc')->paginate(Config('config.page'));
       return $result;
    }
}