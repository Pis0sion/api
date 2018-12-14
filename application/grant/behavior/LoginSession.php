<?php
/**
 * Created by PhpStorm.
 * User: 麻婆伦意识
 * Date: 2018/10/25
 * Time: 22:38
 */

namespace app\grant\behavior;


class LoginSession
{
    /**
     * 存储session登录信息，这样写是可扩展性好，利于升级
     * @Author：麻婆伦意识
     * @DateTime：2018/10/26
     * @param $params
     */
    public function run($params)
    {
        session("userInfo",$params);
    }
}