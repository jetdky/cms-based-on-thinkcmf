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


use app\common\model\ClassModel;
use app\common\model\PacontentModel;
use app\common\model\ProductModel;
use app\index\service\ClassService;

class IndexController extends BaseController
{
    public function index(ClassService $classService, ClassModel $classModel)
    {
//        $pacontentController = new PacontentController();
//        $content = $pacontentController->getPacontentByPageName('新闻动态');
//        halt($content);
//        return view('', $content);
        $content = $classService->getProductCategory('集团产业');
        halt($content);
    }

    public function demo($id)
    {
        echo "<pre>";
        print_r($id);
        echo "</pre>";
        die;
    }
}
