<?php


namespace app\common\model;


use think\Model;

class MessageModel extends Model
{
    public function getCreateTimeAttr($value)
    {
        return date('Y-m-d H:m:i', $value);
    }
}