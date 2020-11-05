<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Released under the MIT License.
// +----------------------------------------------------------------------
// | Author: 老猫 <thinkcmf@126.com>
// +----------------------------------------------------------------------

namespace app\index\controller;


use app\index\service\ClassService;
use app\index\service\NewsService;
use app\index\service\ProductService;
use app\index\service\PacontentService;

class IndexController extends BaseController
{
    public function index(ClassService $classService, PacontentService $pacontentService, ProductService $productService, NewsService $newsService)
    {

        $content['content'] = $pacontentService->getPacontentByPageName('首页');
        $content['productCategory'] = $classService->getCategory('product');
        $content['products'] = $productService->getProducts('', 4)->toArray();
        $content['newsCategory'] = $classService->getCategory('news');
        $content['news'] = $newsService->getNews('', 5)->toArray();

        return view('', $content);
    }
}
