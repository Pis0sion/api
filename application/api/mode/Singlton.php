<?php
/**
 * Created by PhpStorm.
 * User: pis0sion
 * Date: 18-10-15
 * Time: 下午8:41
 */

namespace app\api\mode;


trait Singlton
{
    protected function __construct()
    {}

    public static function getInstance()
    {
        if(!self::$instance instanceof self)
        {
            self::$instance = new self();
        }
        return self::$instance ;
    }

    public function __clone()
    {
        // TODO: Implement __clone() method.
    }
}