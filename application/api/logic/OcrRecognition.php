<?php
/**
 * Created by PhpStorm.
 * User: pis0sion
 * Date: 18-10-12
 * Time: 下午1:47
 */

namespace app\api\logic;

use app\facade\ocr\Ocr;
use think\facade\Config;
use think\facade\Log;

/**
 * 卡片的通用接口
 * Interface Cards
 * @package app\api\logic
 */
interface Cards
{
    /**
     * 识别
     * @param $image
     * @return mixed
     */
    public function verify($image);

    /**
     * 验证
     * @param $response
     * @return mixed
     */
    public function isTrue($response);
}

/**
 * 通用卡片识别
 * Class QcrRecognition
 * @package app\api\logic
 */
class OcrRecognition
{
    protected $image ;

    public function addImage($image)
    {
        $this->image = $image ;
    }

    public function recognition($type)
    {
        $Recognition = app($type);
        $response = $Recognition->verify($this->image);
        Log::record(microtime(true));
        return $Recognition->isTrue($response);
    }
}

/**
 * 抽象卡片的接口  设置平台
 * Class PlatformCards
 * @package app\api\logic
 */
abstract class PlatformCards implements Cards
{
    protected $options ;

    protected $Ocr ;

    public function __construct()
    {
        $this->options = empty($options) ? Config::pull('ocr') : $options;
        $this->Ocr = Ocr::instance($this->options);
    }

    abstract public function verify($image) ;

    abstract public function isTrue($response) ;

}

/**
 * 抽象身份证识别
 * Class IdCards
 * @package app\api\logic
 */
abstract class IdCards extends PlatformCards
{

    protected $option ;

    public function verify($image)
    {
        // TODO: Implement verify() method.
        return $this->Ocr->baidu->idcard($image,$this->option);
    }
    public function isTrue($response)
    {
        $words = "" ;
        Log::record($response);
        if($response['image_status'] == "normal")
        {
            $words = $response['words_result'];
        }
        return $words ;
    }
}

/**
 * 身份证正面识别
 * Class IdCardFront
 * @package app\api\logic
 */
class IdCardFront extends IdCards
{
    protected $option = [
        'id_card_side' => 'front',
    ];
}

/**
 * 身份证反面识别
 * Class IdCardBack
 * @package app\api\logic
 */
class IdCardBack extends IdCards
{
    protected $option = [
        'id_card_side' => 'back',
    ];
}

/**
 * 银行卡识别
 * Class BankCard
 * @package app\api\logic
 */
class BankCard extends PlatformCards
{
    public function verify($image)
    {
        // TODO: Implement verify() method.
        return $this->Ocr->baidu->bankcard($image);
    }
    public function isTrue($response)
    {
        // TODO: Implement isTrue() method.
        $re = "";
        if((array_key_exists("result",$response)&&($response['result']['bank_name'] != "")&&($response['result']['bank_card_type'] != 0)))
        {
            $re = $response['result']['bank_card_number'];
        };
        return $re ;
    }
}

/**
 * 不需要鉴别
 */
class NotVerify extends PlatformCards
{
    public function __construct()
    {

    }

    public function verify($image)
    {
        // TODO: Implement verify() method.
        return true ;
    }

    public function isTrue($response)
    {
        // TODO: Implement isTrue() method.
        return true ;
    }
}


