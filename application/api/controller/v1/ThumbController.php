<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/9
 * Time: 18:01
 */

namespace app\api\controller\v1;


use think\Image;

class ThumbController
{
    public function thumb()
    {
        $image = Image::open("./images/bg.jpg");
        $image->thumb(500,500);
        $image->save("./images/bg_1.jpg");
    }


}