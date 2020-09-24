<?php


namespace app\admin\model;


use think\Model;

class PacontentModel extends Model
{
    public function paGetClass(){
        return $this->hasOne('ClassModel','id','cid');
    }

}