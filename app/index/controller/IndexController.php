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


use app\common\model\ProductModel;

class IndexController extends BaseController
{
    public function index()
    {
        $pacontentController = new PacontentController();
        $content = $pacontentController->getPacontentByPageName('集团概况');

        return view('', $content);
    }

    public function demo($id)
    {
        echo "<pre>";
        print_r($id);
        echo "</pre>";
        die;
    }
}
