<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/29
 * Time: 11:34
 */

namespace app\grant\request;


use app\grant\validate\SaveInfoValidate;

class IndexRequest
{

    public function saveInfo()
    {
        (new SaveInfoValidate())->goCheck();
        return app("Index")->saveInfo();
    }

    public function recycle()
    {
        return app("Index")->recycle();
    }

    public function getRecycleList()
    {
        return app('Index')->getRecycleList();
    }
}