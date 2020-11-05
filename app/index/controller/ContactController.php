<?php
/**
 *created by dengkunyao
 */

namespace app\index\controller;


use app\index\service\PacontentService;

class ContactController extends BaseController
{
    public function index(PacontentService $pacontentService)
    {
        $content['content'] = $pacontentService->getPacontentByPageName('联系方式');

        return view('',$content);

    }
}