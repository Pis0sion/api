<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/29
 * Time: 10:06
 */

namespace app\grant\request;


use app\grant\validate\ManagentValidate;

class ManagentRequest
{

    public function managentAdd()
    {
        (new ManagentValidate())->goCheck();
        return app("Managent")->managentAdd();
    }

    public function managentList()
    {
        return app('Managent')->getManagentList();
    }

}