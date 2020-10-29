<?php


namespace app\index\controller;


use app\common\model\LinkModel;
use think\Controller;

class BaseController extends Controller
{

//pacontent
//public $pacontentType = 5;
//public $pacontentCategoryType = 1;

//video
//    public $videoType = 9; //图片标识
//    public $videoCategoryType = 4;  //分类标识

//product
//    public $productType = 7;
//    public $productCategoryType = 3;

//news
//    public $newsType = 6;
//    public $newsCategoryType = 2;

//recruit
//    public $recruitType = 88;   //图片分类

    public function initialize(){
        //功能模块和表类型以及表分类类型对应
        //   友情链接
        $linkModel = new LinkModel();
        $links     = $linkModel->select();
        $this->assign('links', $links);

    }


}