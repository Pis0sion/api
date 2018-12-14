<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/27
 * Time: 10:11
 */

namespace app\grant\service;


use app\grant\model\CustomerInfoModel;
use app\grant\model\ProductListModel;
use app\lib\exception\ParameterException;
use app\lib\exception\SuccessException;

class ProductService
{
    public function productAdd()
    {
        extract(request()->param());
        $product_status = 1;
        $createtime = sp_datetime();
        $data = compact('createtime','product_name','product_value','product_status');
        $result = (new ProductListModel)->save($data);
        if(!$result)
            throw new ParameterException(['msg'=>"响应错误，联系技术人员"]);
        throw new SuccessException(['msg'=>"添加成功"]);
    }

    public function getProductList()
    {
        $list = ProductListModel::Order('id','desc')->where('recycle','1')->paginate(Config('config.page'));
        return $list;
    }

    public function productStatus()
    {
        extract(request()->param());
        $productModel = new ProductListModel;
        $result = $productModel->save(['product_status'=>$datas['product_status']],['id' => $id]);
        throw new SuccessException(['msg'=>"更新成功"]);
    }

}