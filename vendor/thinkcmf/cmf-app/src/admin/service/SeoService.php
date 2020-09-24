<?php


namespace app\admin\service;

use app\admin\model\SeoModel;
use app\admin\model\SeoContentModel;

class SeoService
{
    public function doSave($seo, $typeId, $id)
    {
        //存储seo
        $data['title'] = $seo['seo_title'];
        $data['keywords'] = $seo['seo_keywords'];
        $data['description'] = $seo['seo_description'];
        $seoModel = new SeoModel();
        $res = $seoModel->save($data);

        //存储seo关系
        $dataSeoContent['seo_id'] = $seoModel->id;
        $dataSeoContent['type'] = $typeId;
        $dataSeoContent['content_id'] = $id;
        $seoContentModel = new SeoContentModel();
        return $res && $seoContentModel->save($dataSeoContent);
    }

    public function read($id, $typeId)
    {
        $seoContentModel = new SeoContentModel();
        $seo = $seoContentModel->where('content_id', $id)->where('type', $typeId)->column('seo_id');
        return $seo;
    }
}