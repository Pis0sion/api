<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/26
 * Time: 9:55
 */

namespace app\grant\controller;


use think\facade\Cache;
use app\grant\request\IndexRequest;
use app\lib\exception\SuccessException;
use think\Controller;

class IndexController extends BaseController
{
    protected $indexRequest;

    public function __construct(IndexRequest $indexRequest)
    {
        parent::__construct();
        $this->indexRequest = $indexRequest;
    }

    public function index()
    {
        $view['title'] = "控制台";
        return view("",$view);
    }

    public function outLogin()
    {
       session(null);
       throw new SuccessException(['msg'=>'退出成功','pointUrl'=>'/license/login']);
    }

    public function saveInfo()
    {
        $view['title'] = '修改密码';
        if(request()->isPost()){
            $this->indexRequest->saveInfo();
        }
        $this->assign('directory','个人资料');
        return view("",$view);
    }

    public function clean()
    {
        $result = Cache::clear();
        throw new SuccessException(['msg'=>'清理缓存成功']);
    }

    /**
     * 公用软删除/还原
     * @Author：麻破伦意识
     * @DateTime：2018/10/30
     */
    public function recycle()
    {
        $this->indexRequest->recycle();
    }

    /**
     * 回收站列表
     * @Author：麻破伦意识
     * @DateTime：2018/10/30
     */
    public function recycleList()
    {
        $view['title'] = '回收站列表';
        $view['data'] = $this->indexRequest->getRecycleList();
        $this->assign('directory','回收站');
        return view("",$view);
    }
}