<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/25
 * Time: 15:50
 */

namespace app\grant\controller;

use app\grant\request\LoginRequest;

class LoginController
{
    protected $loginService;

    public function __construct(LoginRequest $loginService)
    {
        $this->loginService = $loginService;
    }

    public function index()
    {
        return view();
    }

    public function dologin()
    {
        $this->loginService->doAction();
    }
}