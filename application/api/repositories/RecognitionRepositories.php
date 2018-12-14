<?php
/**
 * Created by PhpStorm.
 * User: pis0sion
 * Date: 18-10-12
 * Time: 下午1:46
 */

namespace app\api\repositories;


use app\common\tools\Utils;
use app\facade\qiniu\Qiniu;
use app\lib\exception\ParameterException;

class RecognitionRepositories
{
    protected $imagePath ;

    protected $imagUrl = "http://pfpjmjehg.bkt.clouddn.com/%s?imageMogr2/format/jpg/quality/40";

    protected $returnUrl = "http://pfpjmjehg.bkt.clouddn.com/%s";

    /**
     * 返回压缩后图片的链接
     * @param $name
     * @return array
     * @throws ParameterException
     */
    public function doVerifyCard($name)
    {
        $obj = $_FILES ;
        $uid = request()->param("uid");
        $key = Qiniu::upload($obj,$uid."_".time());
        $imageUrl = sprintf($this->imagUrl,$key);
        $this->returnUrl = sprintf($this->returnUrl,$key);
        $re = $this->createAndVerify($name,$imageUrl) ;
        if(!$re)
        {
            throw new ParameterException([
                "msg"  =>  "上传的图片不符合规定",
            ]);
        }
        $words = $re ;
        $url = $this->returnUrl;
        return Utils::jsonResponse("0000","success",compact('url','words')); ;
    }

    /**
     * 创建图片 并识别图片是否合法
     * @param $name
     * @return mixed
     */
    protected function createAndVerify($name,$imageUrl)
    {
        $instance = app('ocrManager') ;
        $instance->addImage($imageUrl) ;
        return $instance->recognition($name);
    }

    /**
     * 上传七牛云 OSS
     * @return array
     * @throws ParameterException
     */

}