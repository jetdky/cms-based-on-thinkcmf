<?php


namespace app\common\model;


use think\Model;

class VideoModel extends Model
{

    public function videoClass(){
        return $this->hasOne('ClassModel','id','cid');
    }

    //  9为图片标识
    public function videoImg()
    {
        return $this->hasMany('ImgContentModel', 'content_id', 'id')->where('type', 9);
    }

}