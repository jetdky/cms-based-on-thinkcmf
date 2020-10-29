<?php


namespace app\common\model;



class VideoModel extends BaseModel
{
    public function initialize()
    {
        $this->tableType = 9;
        $this->categoryType = 4;
    }
    public function videoClass(){
        return $this->hasOne('ClassModel','id','cid');
    }

    //  9为图片标识
    public function videoImg()
    {
        return $this->hasMany('ImgContentModel', 'content_id', 'id')->where('type', 9);
    }

}