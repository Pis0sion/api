<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/8
 * Time: 9:36
 */

namespace app\api\service\yeepay;


use app\common\tools\Utils;
use app\facade\http\Guzzle;
use app\facade\YeePay\YeePayEncryptAndSigned;
use app\lib\exception\ForbiddenException;
use app\lib\exception\ParameterException;
use GuzzleHttp\Exception\RequestException;
use think\Exception;
use think\facade\Hook;

class Authorization
{

    protected $mainCustomerNumber ;

    protected $md5Key ;

    protected $baseUrl ;

    public function __construct($config)
    {
        if(empty($config))
        {
            throw new ForbiddenException();
        }
        else
        {
            $this->mainCustomerNumber = $config['mainCustomerNumber'];
            $this->md5Key = $config['md5Key'];
            $this->baseUrl = $config['baseUrl'];
        }
    }

    public function payRequest($url = "", $data = [],$str='')
    {
     //   Hook::listen('encryption',$data);
        $data = $this->requestParams($data);
        $data['hmac'] = $this->signure($data);
        $data = $this->isRegAndUpdateStr($data,$str);
        $url = $this->baseUrl.$url ;
        try
        {
            if($str == "reg")
            {
                $re = Utils::curlHttp($url,$data);
                halt($re);
                return json_decode($re,true);
            }else{
                $re = Guzzle::post($url,$data);
            }
        }
        catch (RequestException $exception)
        {
            throw new ForbiddenException();
        }
        Hook::listen('call_numbers');
        return Guzzle::parseJson($re) ;
    }

    public function requestMessage($url="",$data=[],$str='')
    {
        $data = $this->requestParams($data);
        $data['hmac'] = $this->signure($data);
        $data = $this->isRegStr($data,$str);
        $url = $this->baseUrl.$url;
        $requestMessage = $url."?".http_build_query($data);
        return $requestMessage ;
    }

    protected function requestParams($data)
    {
        $data["mainCustomerNumber"] = $this->mainCustomerNumber ;
        return $data;
    }

    protected function signure($data)
    {
        return $re = isset($data['hmac']) ? $data['hmac']:YeePayEncryptAndSigned::signed($data,$this->md5Key);
    }

    protected function isRegAndUpdateStr($data,$str)
    {
        ($str == 'reg') ? ($data['auditStatus'] = 'success') : $data ;
        ($str == 'updateBank') ? ($data['modifyType'] = '2' ) : $data ;
        ($str == 'updateDraw') ? ($data['modifyType'] = '3' ) : $data ;
        ($str == 'updateBaseInfo') ? ($data['modifyType'] = '6' ) : $data ;
        return $data ;
    }


    /**
     * 解密
     * @param string $sStr 密文
     */
    public function decrypt($sStr = "")
    {
        try{
            if(request()->param('channel') != 0)
                throw new ParameterException(['msg'=>'请求错误']);
            $sKey = $this->md5Key;
            if(strlen($sKey)>16) $sKey=substr($sKey,0,16);
            $decrypted= mcrypt_decrypt(
                MCRYPT_RIJNDAEL_128,
                $sKey,
                $this->hexToStr($sStr),
                MCRYPT_MODE_ECB
            );
            $dec_s = strlen($decrypted);
            $padding = ord($decrypted[$dec_s-1]);
            $decrypted = substr($decrypted, 0, -$padding);
            if($decrypted == false)
                throw new ParameterException(['msg'=>'请求错误']);
            return ['code'=>"0000",'success'=>"url解密成功",'url'=>urldecode($decrypted)];
        }catch (Exception $e){
            throw new ParameterException(['msg'=>'请求错误']);
        }
    }
    /**
     * 十六进行转化成字符串
     * @param string $hex
     * @return string
     */
    private function hexToStr($hex="")//十六进制转字符串
    {
        $string="";
        for($i=0;$i<strlen($hex)-1;$i+=2)
            $string.=chr(hexdec($hex[$i].$hex[$i+1]));
        return  $string;
    }
}