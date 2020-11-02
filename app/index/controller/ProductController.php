<?php


namespace app\index\controller;


use app\common\model\ProductModel;
use app\index\service\ClassService;
use app\index\service\ProductService;

class ProductController extends BaseController
{
    //每页数量
    public $everPageNums = 10;

    //关联内容数
    public $relatedNums = 4;
    public function index(ProductModel $productModel)
    {
        $a = new ProductService();
//        $b = $a->getProducts('事业一部','1', 'asc', $productModel);
        $c = $a->getProductDetail(3, $productModel);
        halt($c);

    }


}