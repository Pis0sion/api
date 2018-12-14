<?php
/**
 * Created by PhpStorm.
 * User: pis0sion
 * Date: 18-10-10
 * Time: 下午8:56
 */

namespace app\api\logic;


use app\api\mode\Singlton;
use app\lib\exception\ParameterException;
use think\Image;

class ImageProcess
{

    use Singlton ;

    protected static $instance ;

    protected static $imagePath ;

    protected $width = 500 ;

    protected $height = 500 ;

    protected $image ;


    public function imageAction($imageName)
    {
        $this->setSavePath(request()->param("uid"),$imageName);
        $this->compressAndSaveToLocal($imageName);
        return self::$imagePath;
    }

    /**
     * 接受图片
     * @param $imageName
     * @return mixed
     * @throws ParameterException
     */
    protected function reception($imageName)
    {
//        $params  = request()->only(['uid',$imageName]);
//        $path = $this->setSavePath($params['uid'],$imageName) ;
//        file_put_contents($path,base64_decode($params[$imageName]));
//        return $path;
        return request()->file($imageName);
    }

    public function setSavePath($uid,$imageName)
    {
        $filename = $this->createSaveName($uid,$imageName);
        return self::$imagePath = "./thumb/".$filename.".jpg";
    }

    public function createSaveName($uid,$imageName)
    {
        return $uid.$imageName ;
    }

    protected function compressAndSaveToLocal($imageName)
    {
        // 判断图片的大小
        $path = $this->reception($imageName);
        $re = Image::open($path);
        $re->save(self::$imagePath);
    }

    public static function removeToLocal()
    {
        @unlink(self::$imagePath);
    }

}