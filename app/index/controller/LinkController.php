<?php


namespace app\index\controller;


use app\admin\model\LinkModel;
use think\Controller;

class LinkController extends Controller
{
    //  如果有单独的友情链接页面

    public function index(LinkModel $linkModel){
        $links     = $linkModel->select();
        $this->assign('links', $links);
        return $this->fetch();
    }

}