<?php
/**
 * Time: 2020.09.14
 */

namespace app\admin\controller;


use app\admin\service\ImgService;
use cmf\controller\AdminBaseController;

class ImgController extends AdminBaseController
{
    public function delete($imgId, $contentId, $type)
    {
        $imgService = new ImgService();
        $bool = $imgService->deleteImgByName($imgId, $contentId, $type);
        $bool ? $res = json(['code' => 0]) : $res = json(['code' => 1]);
        return $res;
    }
}