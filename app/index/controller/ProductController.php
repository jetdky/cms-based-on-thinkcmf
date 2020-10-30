<?php


namespace app\index\controller;


use app\common\model\ProductModel;

class ProductController extends BaseController
{
    //产品 获得SEO，标签，关联新闻，关联产品，上线篇
    //SEO中title=keywords，description=产品内容中的汉字（内容是content或者note）

    public function index(ProductModel $productModel)
    {
        // 1.获得页面内容：具体分类的产品/新闻页面的seo信息以及标签信息按照分类获取
        // 欢迎页的seo信息还是从pacontent中获取
        // 2.获得产品
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
            ->with(['productImg.imgs', 'productClass'])
            ->order("order_num ASC")->paginate(10, false);
        $this->assign('productList',$list);
        var_dump($list);die;
        return $this->fetch();

    }

    public function detail(ProductModel $productModel){
        //  根据商品id获取新闻详情
//        $param = $this->request['param'];
        $param['id'] = 1;
        $product = $productModel->with(['productImg', 'productImg.imgs', 'productClass'])->find($param['id']);

        //  下一页
        $prov = $productModel->where('id','>' ,$param['id'])
            ->with(['productImg.imgs', 'productClass'])
            ->order("order_num ASC")->find()->toArray();
        //  下一页
        $next = $productModel->where('id','<' ,$param['id'])
            ->with(['productImg.imgs', 'productClass'])
            ->order("order_num ASC")->find()->toArray();
        $this->assign('prov',$prov);
        $this->assign('next',$next);
        $this->assign('product',$product);
        var_dump($product);die;
        return $this->fetch();
    }

}