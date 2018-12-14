<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/27
 * Time: 10:10
 */

namespace app\grant\controller;


use app\grant\request\ProductRequest;
use think\Controller;

class ProductController extends BaseController
{

    protected $productRequest;

    public function __construct(ProductRequest $productRequest)
    {
        parent::__construct();
        $this->productRequest = $productRequest;
        $this->assign('directory',"产品管理");
    }

    public function add()
    {
        $view['title'] = "添加产品";
        if(request()->isPost())
            $this->productRequest->productAdd();
        return view("",$view);
    }

    public function list()
    {
        if(request()->isPost())
            $this->productRequest->productStatus();
        $view['title'] = "产品列表";
        $view['data'] = $this->productRequest->productList();
        return view("",$view);
    }
}