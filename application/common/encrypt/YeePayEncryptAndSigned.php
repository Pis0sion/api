<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/7
 * Time: 11:17
 */

namespace app\common\encrypt;


class YeePayEncryptAndSigned
{

    public function signed($data,$md5Key)
    {
        return $this->build_sign($data,$md5Key);
    }

    private function buildParam($data=array(),$method="")
    {
        $str = '';
        if (count($data) < 1) return $str;
        foreach ($data as $key => $val)
        {
            if (gettype($val) != 'string') continue;
            if ($method != '')
            {
                if ($str != '') $str .= "&";
                $str .= "$key=$val";
            } else {
                $str .= $val;
            }

        }
        return $str;
    }

    private function build_sign($data,$md5Key)
    {
        $str = $this->buildParam($data,$method="");

        return $this->HmacMd5($str,$md5Key);
    }

    private function HmacMd5($data="",$key="")
    {
        $b = 64;
        if (strlen($key) > $b)
        {
            $key = pack("H*",md5($key));
        }
        $key = str_pad($key, $b, chr(0x00));
        $ipad = str_pad('', $b, chr(0x36));
        $opad = str_pad('', $b, chr(0x5c));
        $k_ipad = $key ^ $ipad ;
        $k_opad = $key ^ $opad;

        return md5($k_opad . pack("H*",md5($k_ipad . $data)));
    }
}