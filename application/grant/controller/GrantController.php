<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/26
 * Time: 16:46
 */

namespace app\grant\controller;


use app\grant\request\GrantRequest;
use think\Controller;

class GrantController extends BaseController
{

    protected $grantRequest;

    public function __construct(GrantRequest $grantRequest)
    {
        parent::__construct();
        $this->grantRequest = $grantRequest;
        $this->assign('directory',"授权管理");
    }

    public function list()
    {
        if(request()->isPost())
            $this->grantRequest->customerStatus();
        $view['title'] = "授权列表";
        $view['data'] = $this->grantRequest->getCustomerList(false);
        return view("",$view);
    }

    public function grantList()
    {
        if(request()->isPost())
            $this->grantRequest->grantStatus();
        $view['title'] = "授权IP列表--".request()->param('title');
        $view['data'] = $this->grantRequest->grantList();
        return view("",$view);
    }

    public function add()
    {
        $view['title'] = "添加授权";
        if(!request()->isGet())
            $this->grantRequest->add();
        $view['productlist'] = $this->grantRequest->getProductList();
        $view['customerlist'] = $this->grantRequest->getCustomerList(true);
        return view("",$view);
    }
}