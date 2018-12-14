<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/29
 * Time: 11:40
 */

namespace app\grant\service;


use app\grant\model\AdminModel;
use app\grant\model\CustomerInfoModel;
use app\grant\model\GrantModel;
use app\grant\model\ProductListModel;
use app\grant\model\RecyCleModel;
use app\lib\exception\ParameterException;
use app\lib\exception\SuccessException;
use think\facade\Hook;

class IndexService
{
    public function saveInfo()
    {
        extract(request()->param());
        $reoldpassword = AdminModel::where('id',session('userInfo.id'))->value('password');
        $flag = sp_str_compare_md5($oldpassword,$reoldpassword);
        if(!$flag)
            throw new ParameterException(['msg'=>'原始密码不正确']);
        $password = sp_str_md5($password);
        $result = AdminModel::where('id',session('userInfo.id'))->update(['password'=>$password]);
        if(!$result)
            throw new ParameterException(['msg'=>'新密码重复原始密码']);
        throw new SuccessException(['msg'=>'修改成功']);
    }

    public function recycle()
    {
        extract(request()->param());
        switch($datas['table'])
        {
            case 'admin':
                if($id == 2)
                    throw new ParameterException(['msg'=>'无法对该账号进行操作']);
                AdminModel::update(['recycle'=>$datas['recycle']],['id'=>$id]);
            break;
            case 'customer_info':
                CustomerInfoModel::update(['recycle'=>$datas['recycle']],['id'=>$id]);
            break;
            case 'grant':
                GrantModel::update(['recycle'=>$datas['recycle']],['id'=>$id]);
            break;
            case 'product_list':
                ProductListModel::update(['recycle'=>$datas['recycle']],['id'=>$id]);
            break;
        }
        Hook::listen('recycle');
        throw new SuccessException(['msg'=>'操作成功']);
    }

    public function getRecycleList()
    {
        $list = RecyCleModel::Order('id','desc')->paginate(Config('config.page'));
        return $list;
    }
}