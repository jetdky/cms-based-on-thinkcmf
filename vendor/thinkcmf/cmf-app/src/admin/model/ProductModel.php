<?php


namespace app\admin\model;


use think\Model;

class ProductModel extends Model
{
    public function productClass(){
        return $this->hasOne('ClassModel','id','cid');
    }
}