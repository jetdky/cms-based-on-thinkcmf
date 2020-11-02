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

use app\common\model\NewsModel;
use app\index\service\ClassService;
use app\index\service\NewsService;

class NewsController extends BaseController
{
    public function index(NewsModel $newsModel)
    {
        $a = new NewsService();
//        $c = $a->getNews('新闻中心', 10,'asc', $newsModel);
//        $b = (new ClassService())->getNewsCategory('莫宁');
        $d = $a->getNewsDetail(3, $newsModel);
        halt($d);
        //TODO: 新闻
    }
}
