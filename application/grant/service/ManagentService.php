<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/29
 * Time: 10:23
 */

namespace app\grant\service;


use app\grant\model\AdminModel;
use app\lib\exception\ParameterException;
use app\lib\exception\SuccessException;

class ManagentService
{
    public function managentAdd()
    {
        extract(request()->param());
        $adminModel = new AdminModel;
        $userInfo = $adminModel->where('username',$username)->find();
        if($userInfo)
           throw new ParameterException(['msg'=>'该账号已存在']);
        $password = sp_str_md5($password);
        $createtime = sp_datetime();
        $operator = session('userInfo.username');
        $data = compact('createtime','username','password','operator');
        $result = $adminModel->save($data);
        if(!$result)
            throw new ParameterException(['msg'=>"响应错误，联系技术人员"]);
        throw new SuccessException(['msg'=>"添加成功"]);
    }

    public function getManagentList()
    {
        $list = AdminModel::Order('id','desc')->where('recycle','1')->paginate(Config('config.page'));
        return $list;
    }

}