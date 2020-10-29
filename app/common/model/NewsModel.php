<?php


namespace app\common\model;


use think\Model;

class NewsModel extends Model
{
    public function initialize()
    {
        $this->tableType = 6;
        $this->categoryType = 2;
    }
    public function newsClass()
    {
        return $this->hasOne('ClassModel', 'id', 'cid');
    }

    public function newsImg()
    {
        return $this->hasMany('ImgContentModel', 'content_id', 'id')->where('type', 6);
    }

    public function setShowTimeAttr($value)
    {
        if (empty($value)) {
            return strtotime(0);
        }
        return strtotime($value);
    }

    public function getShowTimeAttr($value)
    {
        if (empty($value)) {
            return strtotime(0);
        }
        return str_replace(' ', 'T', date('Y-m-d H:i:s', $value));
    }
}