<?php


namespace app\common\model;


use think\Model;

class TagContentModel extends Model
{
    protected $autoWriteTimestamp = false;
    public function tags()
    {
        return $this->hasOne('TagModel', 'id', 'tag_id');
    }
}