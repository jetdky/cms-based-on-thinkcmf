<?php
/**
 *created by dengkunyao
 */

namespace app\index\service;

use app\common\model\ClassModel;
use app\index\service\ClassService;

class ProductService
{
    public function getProducts($categoryName = '', $everyPageNum = 10, $order = 'asc', $productModel)
    {
        $where['type'] = $productModel->categoryType;
        $where['name'] = $categoryName;
        $where['status'] = 1;
        if ($categoryName) {
            $category = (new ClassModel())->where($where)->find();
            $whereNoSubCategory['cid'] = $category['id'];
        }
        $subCategories = (new ClassService())->getProductCategory($categoryName);
        if (!reset($subCategories)) {
            //如果没有子类则直接读分类下产品
            $products = $productModel->where($whereNoSubCategory)->with(['productSeo.seo', 'productTag.tags', 'productImg.imgs'])->order('order_num ' . $order)->paginate($everyPageNum);
        } else {
            //有子类，则读取子类下所有产品
            foreach ($subCategories as $value) {
                $sonCategoryId[] = $value['id'];
            }
            $whereSonId[] = ['cid', 'IN', $sonCategoryId];
            $products = $productModel->where($whereSonId)->with(['productSeo.seo', 'productTag.tags', 'productImg.imgs'])->order('order_num ' . $order)->paginate($everyPageNum);
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

    public function getProductDetail($id, $productModel)
    {
        $detail = $productModel->where('id', $id)->with(['productSeo.seo', 'productTag.tags', 'productImg.imgs'])->find()->toArray();
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
        $detail['pre_and_next']['next'] = $productModel->where('cid', $detail['cid'])->where('id', '>', $detail['id'])->value('id');
        $detail['pre_and_next']['prev'] = $productModel->where('cid', $detail['cid'])->where('id', '<', $detail['id'])->value('id');
        return $detail;
    }
}