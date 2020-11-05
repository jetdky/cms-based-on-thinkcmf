<?php
/**
 *created by dengkunyao
 */

namespace app\index\controller;


use app\index\service\PacontentService;

class NetController extends BaseController
{
    public function index(PacontentService $pacontentService)
    {
        $content['content'] = $pacontentService->getPacontentByPageName('营销网络');

        return view('',$content);
    }
}