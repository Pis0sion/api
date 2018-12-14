<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/30
 * Time: 16:21
 */

namespace app\grant\behavior;


use app\grant\model\RecyCleModel;
use app\lib\exception\ParameterException;

class RecyCle
{

    public function run($params)
    {
        extract(request()->param());
        if($datas['operation'] == 'delete')
        {
            $table_name = $datas['table'];
            $createtime = sp_datetime();
            $tid = $id;
            $operator = session('userInfo.username');
            switch($table_name)
            {
                case 'admin':
                    $beizhu = '管理员列表';
                break;
                case 'customer_info':
                    $beizhu = '授权列表';
                break;
                case 'grant':
                    $beizhu = '授权IP列表';
                break;
                case 'product_list':
                    $beizhu = '产品列表';
                break;
            }
            $result = RecyCleModel::create(compact('table_name','tid','createtime','beizhu','operator'));
        }
        else{
            $result = RecyCleModel::destroy($datas['rid']);
        }
        if(!$result)
            throw new ParameterException(['msg'=>'响应错误，联系技术人员']);
    }
}