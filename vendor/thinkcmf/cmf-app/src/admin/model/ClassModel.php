<?php


namespace app\admin\model;


use think\Model;

class ClassModel extends Model
{

    public function classGetPacontent()
    {
        return $this->belongsTo('Pacontent','cid','id');
    }

}