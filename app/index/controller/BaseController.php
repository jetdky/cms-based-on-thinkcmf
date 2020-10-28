<?php


namespace app\index\controller;


use app\common\model\LinkModel;
use think\Controller;

class BaseController extends Controller
{

//pacontent
//public $type = 5;
//public $categoryType = 1;

//video
//    public $type = 9; //图片标识
//    public $categoryType = 4;  //分类标识

//product
//    public $type = 7;
//    public $categoryType = 3;

//news
//    public $type = 6;
//    public $categoryType = 2;

//recruit
//    public $type = 88;   //图片分类

    public function initialize(){

        //   友情链接
        $linkModel = new LinkModel();
        $links     = $linkModel->select();
        $this->assign('links', $links);

    }


}