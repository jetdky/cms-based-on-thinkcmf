<?php


namespace app\index\controller;


use app\admin\model\ProductModel;

class ProductController extends BaseController
{

    public function index(ProductModel $productModel)
    {
        //  根据新闻分类id获取新闻列表
//        $param = $this->request['param'];
//        $param['cid'] = 8;
        $where = [];
        if (!empty($param['cid'])) {
            $where['cid'] = $param['cid'];
        }
//        $where['lang'] = $param['lang'];
        $where['lang'] = 1;
        $list = $productModel->where($where)
            ->with(['productImg', 'productImg.imgs', 'productClass'])
            ->order("order_num ASC")->paginate(10, false);
        $this->assign('productList',$list);
        var_dump($list);die;
        return $this->fetch();

    }

    public function info(ProductModel $productModel){
        //  根据商品id获取新闻详情
//        $param = $this->request['param'];
        $param['id'] = 1;
        $product = $productModel->with(['productImg', 'productImg.imgs', 'productClass'])->find($param['id']);

        //  下一页
        $prov = $productModel->where('id','>' ,$param['id'])
            ->with(['productImg', 'productImg.imgs', 'productClass'])
            ->order("order_num ASC")->paginate(1, false)->toArray();
        //  下一页
        $next = $productModel->where('id','<' ,$param['id'])
            ->with(['productImg', 'productImg.imgs', 'productClass'])
            ->order("order_num ASC")->paginate(1, false)->toArray();
        $this->assign('prov',$prov);
        $this->assign('next',$next);
        $this->assign('product',$product);
        var_dump($product);die;
        return $this->fetch();
    }

}