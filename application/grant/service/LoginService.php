<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/25
 * Time: 17:21
 */

namespace app\grant\service;

use app\lib\exception\SuccessException;
use think\facade\Hook;
use app\grant\model\AdminModel;
use app\lib\exception\ParameterException;

class LoginService
{

    private $list_login_ip;
    private $list_login_time;
    private $login_num;

    public function __construct()
    {
        $this->list_login_ip = request()->ip() != "::1"?request()->ip():'127.0.0.1';
        $this->list_login_time = sp_datetime();
        $this->login_num = 1;
    }

    /**
     * 检验合法性
     * @Author：麻破伦意识
     * @DateTime：2018/10/25
     */
    public function checkToken()
    {
        $params = request()->param();
        extract($params);
        $user = $this -> check($username,$password);
        $result = $this -> infoUpdate($user);
        Hook::listen('login_session',$result);
        throw new SuccessException(['msg' => '登录成功',"pointUrl"=>request()->domain()."/license/index/index"]);
    }

    protected function check($username,$password)
    {
        $user = $this -> isUser($username);
        $result = sp_str_compare_md5($password,$user['password']);
        if(!$result)
            throw new ParameterException(['msg' => '（*>.<*）账号或密码不正确']);
        return $user;
    }


    protected function isUser($username)
    {
        $result = AdminModel::getByUsername($username);
        if(empty($result))
            throw new ParameterException(['msg'=>"（*>.<*）账号或密码不正确"]);
        return $result;
    }

    protected function infoUpdate($user)
    {
        $list = [
            'list_login_ip' => $this->list_login_ip,
            'list_login_time' => $this->list_login_time,
        ];
        AdminModel::where('id',$user['id'])->inc("login_num")->update($list);
        if(empty($user['list_login_ip']))
        {
            $user['list_login_ip'] = $this->list_login_ip;
            $user['list_login_time'] = $this->list_login_time;
            $user['login_num'] = $this->login_num;

        }
        else{
            $user['login_num'] = $user['login_num']+1;
        }

        return $user;
    }



}