<?php


namespace app\admin\model;


use think\Model;

class NewsModel extends Model
{
    public function newsClass(){
        return $this->hasOne('ClassModel','id','cid');
    }
}