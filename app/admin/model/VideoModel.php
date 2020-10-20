<?php


namespace app\admin\model;


use think\Model;

class VideoModel extends Model
{
    public function videoClass(){
        return $this->hasOne('ClassModel','id','cid');
    }

}