<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/27
 * Time: 15:16
 */

namespace app\grant\request;


use app\grant\validate\CustomerInfoValidate;
use app\grant\validate\GrantValidate;

class GrantRequest
{
    public function add()
    {
        switch(request()->method())
        {
            case "POST":
                (new GrantValidate())->goCheck();
                return app('Grant')->grantAdd();
            break;
            case "PUT":
                (new CustomerInfoValidate())->goCheck();
                return app('Grant')->customerInfoAdd();
            break;
        }
    }

    public function grantList()
    {
        return app('Grant')->getGrantList();
    }

    public function getProductList()
    {
        return app("Grant")->getProductList();
    }

    public function getCustomerList($flag)
    {
        return app("Grant")->getCustomerList($flag);
    }

    public function grantStatus()
    {
        return app("Grant")->grantStatus();
    }

    public function customerStatus()
    {
        return app("Grant")->customerStatus();
    }
}