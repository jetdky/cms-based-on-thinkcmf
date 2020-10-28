<?php


namespace app\index\controller;


use app\admin\model\LinkModel;
use think\Controller;

class BaseController extends Controller
{
    public function initialize(){

        //   友情链接
        $linkModel = new LinkModel();
        $links     = $linkModel->select();
        $this->assign('links', $links);

    }


}