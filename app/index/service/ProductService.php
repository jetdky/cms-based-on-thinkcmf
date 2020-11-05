<?php
/**
 *created by dengkunyao
 */

namespace app\index\service;

use app\common\model\ProductModel;

class ProductService
{
    public function getProducts($id = '', $everyPageNum = 10, $order = 'asc', $keywords = '')
    {
        $productModel = new ProductModel();
        $where['type'] = $productModel->categoryType;
        $where['id'] = $id;
        $where['status'] = 1;
        $whereNoSubCategory = [];
        if ($id) {
            $whereNoSubCategory['cid'] = $id;
        }
        $subCategories = (new ClassService())->getCategory('product', $id);

        if (!$keywords) {
            //非搜索
            if (!reset($subCategories)) {
                //如果没有子类则直接读分类下产品
                $products = $productModel->where($whereNoSubCategory)->with(['productSeo.seo', 'productTag.tags', 'productImg.imgs'])->order('order_num ' . $order)->paginate($everyPageNum);
            } else {
                //有子类，则读取子类下所有产品
                $sonCategoryId = [];
                foreach ($subCategories as $value) {
                    $sonCategoryId[] = $value['id'];
                }
                $whereSonId[] = ['cid', 'IN', $sonCategoryId];
                $products = $productModel->where($whereSonId)->with(['productSeo.seo', 'productTag.tags', 'productImg.imgs'])->order('order_num ' . $order)->paginate($everyPageNum);
            }
        } else {
            $products = $productModel->where($whereNoSubCategory)->where('name','like','%'.$keywords.'%')->with(['productSeo.seo', 'productTag.tags', 'productImg.imgs'])->order('order_num ' . $order)->paginate($everyPageNum);
        }

        //调整格式
        $siteInfo = cmf_get_option('site_info');
        foreach ($products as $key => $value) {
            //如果seo为空
            if (!reset($value['product_seo'])) {
                $products[$key]['product_seo']['title'] = $value['name'] . '-' . $siteInfo['site_name'];
                $products[$key]['product_seo']['keywords'] = $value['name'] . '-' . $siteInfo['site_name'];
                $products[$key]['product_seo']['description'] = '';
            } else {
                $temp = $value['product_seo'][0]['seo'];
                unset($products[$key]['product_seo']);
                $products[$key]['product_seo'] = $temp;
            }
            //如果标签不为空
            if (reset($value['product_tag'])) {
                $temp = $value['product_tag'][0]['tags']['id'];
                unset($products[$key]['product_tag']);
                $products[$key]['product_tag'] = $temp;
            }
        }

        return $products;
    }

    public function getProductDetail($id)
    {
        $productModel = new ProductModel();
        $detail = $productModel->where('id', $id)->with(['productSeo.seo', 'productTag.tags', 'productImg.imgs'])->find()->toArray();

        //调整格式
        $siteInfo = cmf_get_option('site_info');
        //如果seo为空
        if (!reset($detail['product_seo'])) {
            $detail['product_seo']['title'] = $detail['name'] . '-' . $siteInfo['site_name'];
            $detail['product_seo']['keywords'] = $detail['name'] . '-' . $siteInfo['site_name'];
            $detail['product_seo']['description'] = '';
        } else {
            $temp = $detail['product_seo'][0]['seo'];
            unset($detail['product_seo']);
            $detail['product_seo'] = $temp;
        }
        //如果标签不为空
        if (reset($detail['product_tag'])) {
            $temp = $detail['product_tag'][0]['tags']['id'];
            unset($detail['product_tag']);
            $detail['product_tag'] = $temp;
        }

        $detail['pre_and_next']['next'] = $productModel->field("id,name")->where('cid', $detail['cid'])->where('id', '>', $detail['id'])->find();
        $detail['pre_and_next']['prev'] = $productModel->field("id,name")->where('cid', $detail['cid'])->where('id', '<', $detail['id'])->find();
        return $detail;
    }

    public function getProductNums($id = '', $order = 'asc', $keywords='')
    {
        $productModel = new ProductModel();
        $where['type'] = $productModel->categoryType;
        $where['id'] = $id;
        $where['status'] = 1;
        $whereNoSubCategory = [];
        if ($id) {
            $whereNoSubCategory['cid'] = $id;
        }
        $subCategories = (new ClassService())->getCategory('product', $id);
        if (!$keywords) {

            if (!reset($subCategories)) {
                //如果没有子类则直接读分类下产品
                $products = $productModel->where($whereNoSubCategory)->count();
            } else {
                //有子类，则读取子类下所有产品
                $sonCategoryId = [];
                foreach ($subCategories as $value) {
                    $sonCategoryId[] = $value['id'];
                }
                $whereSonId[] = ['cid', 'IN', $sonCategoryId];
                $products = $productModel->where($whereSonId)->count();
            }
        }else{
            $products = $productModel->where($whereNoSubCategory)->where('name','like','%'.$keywords.'%')->count();
        }
        return $products;
    }
}