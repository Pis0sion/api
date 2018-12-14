<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/7
 * Time: 9:53
 */

namespace app\api\controller\v1;


use app\api\repositories\OcrRepositories;
use app\api\repositories\RecognitionRepositories;
use app\api\validate\BankValidate;
use app\api\validate\IdCardBack;
use app\api\validate\IdCardFront;
use app\api\validate\NotVerify;
use think\facade\Log;

class OcrController
{
    protected $recognitionRepositories ;

    /**
     * 1   接收客户端图片
     * 2   压缩接收的图片
     * 3   保存本地
     * 4   验证ocr是否合法
     * 5   合法上传qiniu OSS
     * 6   返回key
     * OcrController constructor.
     * @param OcrRepositories $ocrRepositories
     */

    public function __construct(RecognitionRepositories $recognitionRepositories)
    {
        $this->recognitionRepositories = $recognitionRepositories ;
    }

    /**
     *  /api/v1/idcard/front   uid   idcardFront
     * @return array
     * @throws \app\lib\exception\ParameterException
     */
    public function doFront()
    {
        return $this->recognitionRepositories->doVerifyCard("idcardFront");
    }

    /**
     * /api/v1/idcard/back   uid   idcardBack
     * @return array
     * @throws \app\lib\exception\ParameterException
     */
    public function doBack()
    {
        return $this->recognitionRepositories->doVerifyCard("idcardBack");
    }

    /**
     * /api/v1/bankCard      uid   bankcard
     * @return array
     * @throws \app\lib\exception\ParameterException
     */
    public function doBank()
    {
        return $this->recognitionRepositories->doVerifyCard("bankcard");
    }

    /**
     * /api/v1/notverify      uid   notverify
     * @return array
     * @throws \app\lib\exception\ParameterException
     */
    public function doNoVerify()
    {
        return $this->recognitionRepositories->doVerifyCard("notverify");
    }


    public function DpiSetting()
    {
        $im = new \Imagick("http://pfpjmjehg.bkt.clouddn.com/123_1539925779.jpg");
        $im->setImageUnits(\Imagick::RESOLUTION_PIXELSPERINCH);
        $im->setImageResolution(300,300);
        $im->setImageFormat("jpg");
        file_put_contents("./thumb/bank_demo.jpg",$im);
    }

}