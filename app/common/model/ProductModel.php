<?php


namespace app\common\model;



class ProductModel extends BaseModel
{
    public function initialize()
    {
        $this->tableType = 7;
        $this->categoryType = 3;
    }

    public function productClass(){
        return $this->hasOne('ClassModel','id','cid');
    }

    public function productImg()
    {
        return $this->hasMany('ImgContentModel', 'content_id', 'id')->where('type', 7);
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