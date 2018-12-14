<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/27
 * Time: 11:25
 */

namespace app\grant\request;


use app\grant\validate\ProductValidate;

class ProductRequest
{
    public function productAdd()
    {
        (new ProductValidate())->goCheck();
        return app("Product")->productAdd();
    }

    public function productList()
    {
        return app("Product")->getProductList();
    }

    public function productStatus()
    {
        
        return app("Product")->productStatus();
    }
}