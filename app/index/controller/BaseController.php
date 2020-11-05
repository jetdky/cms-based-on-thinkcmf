<?php


namespace app\index\controller;


use app\index\service\NavService;
use app\index\service\PacontentService;
use app\index\service\ProductService;
use think\Controller;

class BaseController extends Controller
{
    protected function initialize()
    {
        //导航
        $navService = new NavService();
        $pacontentService = new PacontentService();
        $content['nav'] = $navService->getTreeNav();
        $content['siteInfo'] = cmf_get_option('site_info');
        $content['bottom'] = $pacontentService->getPacontentByPageName('顶部底部侧边');
        //电话  {$bottom['pageData'][1]['data'][0]['content']|htmlspecialchars_decode}

        $this->assign($content);
    }

    public function getTopAndBottom()
    {
        $pacontentService = new PacontentService();
        return $pacontentService->getPacontentByPageName('顶部底部侧边');

    }
}