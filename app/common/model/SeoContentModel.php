<?php


namespace app\common\model;

use think\model;

class SeoContentModel extends model
{
    protected $autoWriteTimestamp = false;

    public function seo()
    {
        return $this->hasOne('SeoModel', 'id', 'seo_id');
    }
}