<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/27
 * Time: 14:54
 */

namespace app\common\tools;


class Utils
{

    public static function makeResquestNo()
    {
        $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
        $orderSn =
            $yCode[intval(date('Y')) - 2018] . strtoupper(dechex(date('m'))) . date(
                'd') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf(
                '%02d', rand(0, 99));
        return $orderSn;
    }

    public static function jsonResponse($code,$message,$data)
    {
        $code = $code ;
        $message = $message ;
        $data = $data ;
        return compact("code","message","data");
    }
    public static function curlHttp($url,$params)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 100);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SAFE_UPLOAD, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        if( ! $result = curl_exec($ch))
        {
            trigger_error(curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }
}