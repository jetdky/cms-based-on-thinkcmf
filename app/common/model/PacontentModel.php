<?php


namespace app\common\model;



class PacontentModel extends BaseModel
{
    public function initialize()
    {
        $this->tableType = 5;
        $this->categoryType = 1;
    }
    public function paGetClass(){
        return $this->hasOne('ClassModel','id','cid');
    }
    public function pacontentImg()
    {
        return $this->hasMany('ImgContentModel', 'content_id', 'id')->where('type', $this->tableType);
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