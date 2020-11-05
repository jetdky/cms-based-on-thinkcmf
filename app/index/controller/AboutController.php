<?php
/**
 *created by dengkunyao
 */

namespace app\index\controller;


use app\index\service\PacontentService;

class AboutController extends BaseController
{
    public function index(PacontentService $pacontentService)
    {
        $content['content'] = $pacontentService->getPacontentByPageName('关于我们');

        return view('', $content);
    }
}