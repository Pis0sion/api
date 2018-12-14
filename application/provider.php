<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用容器绑定定义
return [
    "Encrypt"                  => \app\tools\AesEncrypt::class ,
    "Jmf"                      => \app\api\service\jmf::class ,
    "YeePayCollectionTreasure" => \app\api\service\yeepay\YeePayCollectionTreasure::class,
    "YeePayRepayment"          => \app\api\service\yeepay\YeePayRepayment::class ,
    "YeePayRepaymentThree"     => \app\api\service\yeepay\YeePayRepaymentThree::class ,
    /**
     * 工厂
     */
    "YeePayCollectionFactor"         => \app\api\service\YeePayCollectionFactory::class,
    "YeePayRepaymentFactor"          => \app\api\service\YeePayRepaymentFactory::class,
    "YeePayRepaymentThreeFactor"     => \app\api\service\YeePayRepaymentThreeFactory::class,
    /**
     * 工具
     */
    "Qiniu"                 => \gmars\qiniu\Qiniu::class,
    /**
     * 10 12
     */
    "ocrManager"                  =>   \app\api\logic\OcrRecognition::class ,
    "idcardFront"                 =>   \app\api\logic\IdCardFront::class ,
    "idcardBack"                  =>   \app\api\logic\IdCardBack::class ,
    "bankcard"                    =>   \app\api\logic\BankCard::class ,
    "notverify"                   =>  \app\api\logic\NotVerify::class ,
    /**
     * 授权控制中心
     */
    "loginToken"                       =>    \app\grant\service\LoginService::class,
    "Grant"                            =>    \app\grant\service\GrantService::class,
    "Product"                          =>    \app\grant\service\ProductService::class,
    "Managent"                         =>    \app\grant\service\ManagentService::class,
    "Index"                            =>    \app\grant\service\IndexService::class,
];
