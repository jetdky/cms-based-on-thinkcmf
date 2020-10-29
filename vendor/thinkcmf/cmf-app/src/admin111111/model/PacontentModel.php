<?php


namespace app\common\model;


use think\Model;

class PacontentModel extends Model
{
    public function paGetClass(){
        return $this->hasOne('ClassModel','id','cid');
    }
    public function pacontentImg()
    {
        return $this->hasMany('ImgContentModel', 'content_id', 'id')->where('type', 5);
    }
    public function setShowTimeAttr($value)
    {
        return strtotime($value);
    }

    public function getShowTimeAttr($value)
    {
        return str_replace(' ', 'T', date('Y-m-d H:i:s', $value));
    }


}