<?php


namespace app\common\model;



class RecruitModel extends BaseModel
{

    public function initialize()
    {
        $this->tableType = 88;
    }
    public function recruitImg()
    {
        return $this->hasMany('ImgContentModel', 'content_id', 'id')->where('type', 88);
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