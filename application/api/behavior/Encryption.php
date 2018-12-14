<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/11/5
 * Time: 10:01
 */

namespace app\api\behavior;


use app\lib\exception\ParameterException;
use think\facade\Config;

class Encryption
{
    public function run($params)
    {
        if(!request()->param('key'))
            throw new ParameterException(['msg'=>'密匙key不可为空']);
        $this->check($params);
        return true;
    }

    private function check($params)
    {
        $params['channel'] = request()->param('channel');
        $key = request()->param('key');
        $data = array_filter($params); ksort($data);
        $str = $this->buildParam($data);
        $this->HmacEncryption($str,$key);
    }

    private function buildParam(array $data)
    {
        $str = '';
        foreach ($data as $key=>$value)
        {
            if(gettype($value) != "string")
                throw new ParameterException(['msg'=>'字符类型不正确']);
            if ($str != '') $str .= "&";
            $str .= "$key=$value";
        }
        return $str;
    }

    private function HmacEncryption($str = "",$key = "")
    {
        if(gettype($key) != "string")
            throw new ParameterException(['msg'=>'非法的key']);
        if (CRYPT_STD_DES == 1)
        {
            $strCrypt = crypt($str,Config::get('Encyption.config.salt'));
        }
        else
        {
            throw new ParameterException(['msg'=>'该环境不支持两字符 salt散列']);
        }
        $newKey = "==".md5("L".base64_encode(Config::get('Encyption.config.startHash'))."T".md5($strCrypt).base64_encode(Config::get('Encyption.config.endHash'))."T");
        if($newKey != $key)
            throw new ParameterException(['msg'=>'key值校验不正确','errorCode'=>'10011']);
    }
}