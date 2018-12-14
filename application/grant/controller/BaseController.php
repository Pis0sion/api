<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/30
 * Time: 17:17
 */

namespace app\grant\controller;


use think\Controller;

class BaseController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!session('?userInfo')){
            $point_url = '/license/login';
            return $this->redirect($point_url);
        }
    }
}