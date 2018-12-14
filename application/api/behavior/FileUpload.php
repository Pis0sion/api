<?php
/**
 * Created by PhpStorm.
 * User: pis0sion
 * Date: 18-10-26
 * Time: 上午9:29
 */

namespace app\api\behavior;


use app\lib\exception\ParameterException;

class FileUpload
{
    protected $MustBe = [
        'bankCardPhoto',
        'idCardPhoto',
        'idCardBackPhoto',
        'personPhoto',
    ];

    public function run($params)
    {
        $keys = array_keys($_FILES);
        // 判断接受的图片
        $diff = array_diff($this->MustBe,$keys);
        if(count($diff) != 0 )
        {
            throw new ParameterException([
                'msg' => "图片上传不合法",
            ]);
        }
        $this->uploadFile($params);

    }
    private function uploadFile($uid){
        //设置上传文件大小限制(单位b)
        $filename = [];
        $max_size = 512000;
        //设置上传文件的文件格式限制
        $format=array("image/jpeg","image/png","image/jpg");
        //文件上传目录
        $dir=  "./uploads/".$uid."/";
        //判断上传目录，不存在就创建
        if(!is_dir($dir)){
            mkdir($dir,0777);
        }
        $keys = array_keys($_FILES);
        //批量上传文件
        for($i=0,$j=count($_FILES);$i<$j;$i++){
            //被上传文件的名称
            $name= $keys[$i];
            //被上传文件的类型
            $type=$_FILES[$name]["type"];
            //被上传文件的大小，以字节计
            $size=$_FILES[$name]["size"];
            //存储在服务器的文件的临时副本的名称
            $tmp_name=$_FILES[$name]["tmp_name"];
            //由文件上传导致的错误代码
            $error=$_FILES[$name]["error"];
            //判断文件大小
            if($size>$max_size){
                exit("文件大小超出最大值");
            }
            //判断文件格式
            if(!in_array($type,$format)){
                exit("无效的文件格式");
            }
            //生成文件名
            date_default_timezone_set("PRC");
            $file_name = $uid."-".$name;
            //获取文件格式
            $ext=substr($type, strpos($type, "/")+1);
            if($error>0){
                exit($error);
            }else{
                if(move_uploaded_file($tmp_name, $dir.$file_name.".".$ext)){
                    $filename[$name] = $dir.$file_name.".".$ext ;
                }
            }
        }

        return $filename ;
    }
}