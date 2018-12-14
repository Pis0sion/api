<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * http请求
 * @param  string  $url    请求地址
 * @param  boolean|string|array $params 请求数据
 * @param  integer $ispost 0/1，是否post
 * @param  array  $header
 * @param  $verify 是否验证ssl
 * @return string|boolean          出错时返回false
 */
function sp_http($url, $params = false, $ispost = 0, $header = array(), $verify = false)
{
    $httpInfo = array();
    $ch = curl_init();
    if(!empty($header)){
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    }
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    //忽略ssl证书
    if($verify === true){
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    } else {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    }
    if ($ispost) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_URL, $url);
    } else {
        if (is_array($params)) {
            $params = http_build_query($params);
        }
        if ($params) {
            curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
        } else {
            curl_setopt($ch, CURLOPT_URL, $url);
        }
    }
    $response = curl_exec($ch);
    if ($response === FALSE) {
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        return false;
    }
    curl_close($ch);
    return $response;
}

/**
 * 万能无限递归
 * @Author: 麻破伦意识
 * @DateTime: 2018/10/7 18:42
 * @param $data 二位数组
 * @param $id  父亲id
 * @param $condition 指定条件字段
 * @param string $type  数据类型 all类型  tree类型
 * @param null $field  获取字段 null为全部
 * @return
 */
function sp_Infinite(array $data, $id, $condition, $type = "all", $field = null)
{
    $ancestry = array();
    array_walk($data, function($value, $key)use(&$ancestry,$data,$id,$condition,$type,$field){
        if($value[$condition] == $id){
            if($type == "all"){
                if(empty($field)){
                    $ancestry[] = $value;
                }else{
                    $ancestry[] = $value[$field];
                }
                unset($data[$key]);
                $ancestry = array_merge($ancestry, Infinite($data,$value['id'],$condition,$type,$field));
            }elseif($type == "tree"){
                $value['son'] = Infinite($data,$value['id'],$condition,$type,$field);
                $ancestry[] = $value;
                unset($data[$key]);
            }
        }
    });
    return $ancestry;
}

/**
 * 随机生成指定长度字符串
 * @Author   麻破伦意识
 * @email    1364576479@qq.com
 * @DateTime 2018-10-08T09:27:07+0800
 * @param    int                 $length [长度]
 * @return   string              [指定长度字符串]
 */
function sp_random($length)
{
    $hash = '';
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
    $max = strlen($chars) - 1;
    mt_srand((double)microtime() * 1000000);
    for($i = 0; $i < $length; $i++)
    {
        $hash .= $chars[mt_rand(0, $max)];
    }
    return $hash;
}

/**
 * 获取ip地址
 * @Author: 麻破伦意识
 * @DateTime: 2018/10/8 9:34
 * @return ip
 */
function sp_getIP()
{
    static $realip;
    if (isset($_SERVER)){
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $realip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $realip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")){
            $realip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("HTTP_CLIENT_IP")) {
            $realip = getenv("HTTP_CLIENT_IP");
        } else {
            $realip = getenv("REMOTE_ADDR");
        }
    }
    return $realip;
}

/**
 * 新浪接口短链接生成   http://t.cn/ev1h3fp
 * @Author: 麻破伦意识
 * @DateTime: 2018/10/8 9:41
 * @param $url
 * @param $api
 * @param $source
 * @return 接口抓取数据
 */
function sp_dwz($url)  //TODO 待更新
{
    $api = 'http://api.t.sina.com.cn/short_url/shorten.json'; // json
    $source = '1340181653';
    $url_long = $url;
    $request_url = sprintf($api.'?source=%s&url_long=%s', $source, $url_long);
    $data = file_get_contents($request_url);
    $data = json_decode($data,1);
    $data = $data['0']['url_short'];
    return $data;
}

/**
 * 自定义md5加密
 * @Author: 麻破伦意识
 * @DateTime: 2018/10/8 15:03
 * @param $str 要加密的密码
 * @return
 */
function sp_str_md5($str)
{
    if(defined('SITE_ENCRYPTION_KEY_BEGIN') && define('SITE_ENCRYPTION_KEY_END')){
        $str_md5 = '###'.md5("L".base64_encode(SITE_ENCRYPTION_KEY_BEGIN) . md5($str) . base64_encode(SITE_ENCRYPTION_KEY_END)."T");
    }else{
        $str_md5 = '###'.md5("L".base64_encode("bceogdiinnnging") . md5($str) . base64_encode("ceondding")."T");
    };
    return $str_md5;
}

/**
 * 校验密码是否一致
 * @Author: 麻破伦意识
 * @DateTime: 2018/10/8 15:11
 * @param $password 要比较的密码
 * @param $comPassword 数据保存已经加密的密码
 * @return boole
 */
function sp_str_compare_md5($password,$comPassword)
{
    return sp_str_md5($password) == $comPassword;
}

/**
 * 记录日志
 * @Author: 麻破伦意识
 * @DateTime: 2018/10/8 15:39
 * @param string $file 文件名及路径
 * @param $content 数据内容
 * @param int $isTime 文件名是否需要时间化格式
 * @param string $type 存储数据类型 ARRAY | JSON
 */
function sp_log($file="log", $content, $isTime = 1, $type = "ARRAY")
{
    date_default_timezone_set('PRC');
    if($isTime != 0){
        $file = $file."_".date("Y-m").".log";
    }else{
        $file = $file.".log";
    }
    switch($type){
        case "JSON":
            $content = json_encode($content);
            break;
    }
    file_put_contents($file,var_export($content,true).PHP_EOL.PHP_EOL,FILE_APPEND);
}

/**
 * 取数组某字段求和值
 * @Author: 麻破伦意识
 * @DateTime: 2018/10/8 10:12
 * @param array $data
 * @param $field
 * @return 求和值
 */
function sp_sumToArray(array $data, $field)
{
    return array_sum(array_column($data,$field));
}

/**
 * 检索该字段是否在数组中存在
 * @Author: 麻破伦意识
 * @DateTime: 2018/10/8 13:38
 * @param array $data
 * @param $field
 * @return  $data
 */
function sp_filterVar(array $data, $field)
{
    return array_filter($data, function($value) use ($field){
        if(@$value[$field] == 0){
            return false;
        }
        return true;
    });
}

/**
 * 返回指定时间
 * @Author: 麻破伦意识
 * @DateTime: 2018/10/8 13:46
 * @param $time
 * @return
 */
function sp_datetime($time = '')
{
    if(empty($time))
        $time = time();
    date_default_timezone_set('PRC');
    return date("Y-m-d H:i:s",$time);
}

/**
 * 数据类型转换（仅支持XML（待定）、JSON、ARRAY）
 * @Author: 麻破伦意识
 * @DateTime: 2018/10/8 16:40
 * @param $data 数据内容
 * @param $Enter 传入数据类型
 * @param $outOf 传出数据类型
 * @return
 */
function sp_data_transAtion($result, $Enter, $outOf)
{
    switch($outOf){
        case "JSON";
            switch($Enter){
                case "ARRAY";
                    $result = json_encode($result);
                    break;
            }
            break;
        case "ARRAY";
            switch($Enter){
                case "JSON";
                    $result = json_decode($result,true);
                    break;
            }
            break;
    }
    return $result;
}


/**
 * 过滤检索防sql注入
 * @Author   麻破伦意识
 * @email    1364576479@qq.com
 * @DateTime 2018-10-16T09:08:41+0800
 * @param    [type]                   $str [description]
 * @return   [type]                        [description]
 */
function safe_string($str){ //过滤安全字符
    $str=str_replace("'","",$str);
    $str=str_replace('"',"",$str);
    $str=str_replace(" ","$nbsp;",$str);
    $str=str_replace("//","",$str);
    $str=str_replace("http","",$str);
    $str=str_replace("?","",$str);
    $str=str_replace(":","",$str);
    $str=str_replace("#","",$str);
    $str=str_replace("\n;","<br/>",$str);
    $str=str_replace("<","",$str);
    $str=str_replace(">","",$str);
    $str=str_replace("\t"," ",$str);
    $str=str_replace("\r","",$str);
    $str=str_replace("/[\s\v]+/"," ",$str);
    return $str;
}


//
//	TODO 过滤检索防SQL注入函数
//
//	TODO 图片处理公用函数
//
//  TODO 更多处理函数封装进行中。。。
