<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/29
 * Time: 10:04
 */

namespace app\grant\controller;


use app\grant\request\ManagentRequest;
use think\Controller;

class ManagentController extends BaseController
{
    protected $managentRequest;

    public function __construct(ManagentRequest $managentRequest)
    {
        parent::__construct();
        $this->managentRequest = $managentRequest;
        $this->assign('directory','管理员管理');
    }

    public function add()
    {
        $view['title'] = "添加管理员";
        if(request()->isPost())
            $this->managentRequest->managentAdd();
        return view("",$view);
    }

    public function list()
    {
        $view['title'] = "管理员列表";
        $view['data'] = $this->managentRequest->managentList();
        return view("",$view);
    }

}