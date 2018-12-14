<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/26
 * Time: 17:05
 */

namespace app\grant\model;


use think\Model;

class GrantModel extends Model
{
    protected $table = "cc_grant";

    protected $visible;

    public function productList()
    {
        return $this->belongsTo("\\app\\grant\\model\\ProductListModel",'product_id','id');
    }

}