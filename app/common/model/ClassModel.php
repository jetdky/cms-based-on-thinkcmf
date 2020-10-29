<?php


namespace app\common\model;


use think\Model;

class ClassModel extends Model
{

    public function classGetPacontent()
    {
        return $this->belongsTo('Pacontent','cid','id');
    }

    public function classSeo()
    {
        return $this->hasMany('SeoContentModel', 'content_id', 'id');
    }

    public function classTag()
    {
        return $this->hasMany('TagContentModel', 'content_id', 'id');
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