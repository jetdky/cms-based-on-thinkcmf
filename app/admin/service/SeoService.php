<?php


namespace app\admin\service;

use app\common\model\SeoModel;
use app\common\model\SeoContentModel;

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
        $seoModel = new SeoModel();
        $seoId = $seoContentModel->where('content_id', $id)->where('type', $typeId)->value('seo_id');
        if($seoId){
            $seo = $seoModel->find($seoId)->toArray();
            $seo['is_auto_seo'] = 0;
            return $seo;
        }else{
            $seo['is_auto_seo'] = 1;
            $seo['title'] = "";
            $seo['description'] = "";
            $seo['keywords'] = "";
            return $seo;
        }

    }

    public function delete($id, $typeId)
    {
        $seoContentModel = new SeoContentModel();
        $seoId = $seoContentModel->where('content_id', $id)->where('type', $typeId)->column('seo_id');
        SeoModel::destroy($seoId);
        return $seoContentModel->where('content_id', $id)->where('type', $typeId)->delete();
    }
}