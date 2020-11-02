<?php
/**
 *created by dengkunyao
 */

namespace app\index\service;


use app\common\model\ClassModel;
use app\common\model\SeoContentModel;
use app\common\model\SeoModel;

class SeoService
{
    public function readClass($id, $typeId)
    {
        $seoContentModel = new SeoContentModel();
        $seoModel = new SeoModel();
        $seoId = $seoContentModel->where('content_id', $id)->where('type', $typeId)->value('seo_id');
        $classData = (new ClassModel())->find($id)->toArray();
        $siteInfo = cmf_get_option('site_info');
        if (!$seoId) {
            $seo['title'] = $classData['name'] . '-' . $siteInfo['site_name'];
            $seo['keywords'] = $seo['title'];
            $seo['description'] = '';
        } else {
            $seo = (new SeoModel())->find($seoId)->toArray();
        }
        return $seo;
    }
}