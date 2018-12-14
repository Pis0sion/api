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

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::miss('public/miss');

Route::group('api/:version',function()
{
    Route::rule('idcard/front','api/:version.Ocr/doFront');
    Route::rule('idcard/back','api/:version.Ocr/doBack');
    Route::rule('bankCard','api/:version.Ocr/doBank');
    Route::rule('notverify','api/:version.Ocr/doNoVerify');
    Route::rule('image','api/:version.Ocr/DpiSetting');

});

Route::group('paychannel/:version',function()
{
    Route::rule('info','api/:version.PayChannels/userInfo');
    Route::rule('setFeeFate','api/:version.PayChannels/setQueryFee','POST');
    Route::rule('balance','api/:version.PayChannels/balance','POST');
    Route::rule('register','api/:version.PayChannels/register','POST');
    Route::rule('queryFee','api/:version.PayChannels/queryFee','POST');
    Route::rule('queryOrder','api/:version.payChannels/queryOrder','POST');
    Route::rule('transferQuery','api/:version.payChannels/transferQuery','POST');
    Route::rule('bindOrPay','api/:version.payChannels/bindOrPay','POST');
    Route::rule('updateBank','api/:version.payChannels/updateBank','POST');
    Route::rule('updateMobile','api/:version.payChannels/updateMobile','POST');
    Route::rule('queryBindBankRecord','api/:version.payChannels/queryBindBankRecord','POST');
    Route::rule('withDrawByCardApi','api/:version.payChannels/withDrawByCardApi','POST');
    Route::rule('orderSecondPayApi','api/:version.payChannels/orderSecondPayApi','POST');
    Route::rule('decryptRule','api/:version.payChannels/decryptRule','POST');
});


Route::group('license',function()
{
    Route::rule('login','grant/login/index','GET')->middleware("yesLogin");
    Route::rule('dologin','grant/login/dologin','POST');
    Route::rule('index/outLogin','grant/index/outLogin','POST');
    Route::rule('index/index','grant/index/index','GET');
    Route::rule('index/saveInfo','grant/index/saveInfo','GET|POST');
    Route::rule('index/clean','grant/index/clean');
    Route::rule('index/recycle','grant/index/recycle');
    Route::rule('index/recyclelist','grant/index/recycleList');
    Route::rule('product/add','grant/product/add');
    Route::rule('product/list','grant/product/list');
    Route::rule('grant/add','grant/grant/add');
    Route::rule('grant/list','grant/grant/list');
    Route::rule('grant/grantlist','grant/grant/grantList');
    Route::rule('managent/add','grant/managent/add');
    Route::rule('managent/list','grant/managent/list');

});
