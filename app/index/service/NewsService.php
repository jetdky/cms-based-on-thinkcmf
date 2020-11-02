<?php
/**
 *created by dengkunyao
 */

namespace app\index\service;


use app\common\model\ClassModel;

class NewsService
{
    public function getNews($categoryName = '', $everyPageNum = 10, $order = 'asc', $newsModel)
    {
        $where['type'] = $newsModel->categoryType;
        $where['name'] = $categoryName;
        $where['status'] = 1;
        if ($categoryName) {
            $category = (new ClassModel())->where($where)->find();
            $whereNoSubCategory['cid'] = $category['id'];
        }
        $subCategories = (new ClassService())->getNewsCategory($categoryName);
        if (!reset($subCategories)) {
            //如果没有子类则直接读分类下产品
            $news = $newsModel->where($whereNoSubCategory)->with(['newsSeo.seo', 'newsTag.tags', 'newsImg.imgs'])->order('order_num ' . $order)->paginate($everyPageNum);
        } else {
            //有子类，则读取子类下所有产品
            foreach ($subCategories as $value) {
                $sonCategoryId[] = $value['id'];
            }
            $whereSonId[] = ['cid', 'IN', $sonCategoryId];
            $news = $newsModel->where($whereSonId)->with(['newsSeo.seo', 'newsTag.tags', 'newsImg.imgs'])->order('order_num ' . $order)->paginate($everyPageNum);
        }

        //调整格式
        $siteInfo = cmf_get_option('site_info');
        foreach ($news as $key => $value) {
            //如果seo为空
            if (!reset($value['news_seo'])) {
                $news[$key]['news_seo']['title'] = $value['name'] . '-' . $siteInfo['site_name'];
                $news[$key]['news_seo']['keywords'] = $value['name'] . '-' . $siteInfo['site_name'];
                $news[$key]['news_seo']['description'] = '';
            } else {
                $temp = $value['news_seo'][0]['seo'];
                unset($news[$key]['news_seo']);
                $news[$key]['news_seo'] = $temp;
            }

            //如果标签不为空
            if (reset($value['news_tag'])) {
                $temp = $value['news_tag'][0]['tags']['id'];
                unset($news[$key]['news_tag']);
                $news[$key]['news_tag'] = $temp;
            }
        }
        return $news;
    }

    public function getNewsDetail($id, $newsModel)
    {
        $detail = $newsModel->where('id', $id)->with(['newsSeo.seo', 'newsTag.tags', 'newsImg.imgs'])->find()->toArray();
        $siteInfo = cmf_get_option('site_info');

        //如果seo为空
        if (!reset($detail['news_seo'])) {
            $detail['news_seo']['title'] = $detail['name'] . '-' . $siteInfo['site_name'];
            $detail['news_seo']['keywords'] = $detail['name'] . '-' . $siteInfo['site_name'];
            $detail['news_seo']['description'] = '';
        } else {
            $temp = $detail['news_seo'][0]['seo'];
            unset($detail['news_seo']);
            $detail['news_seo'] = $temp;
        }

        //如果标签不为空
        if (reset($detail['news_tag'])) {
            $temp = $detail['news_tag'][0]['tags']['id'];
            unset($detail['news_tag']);
            $detail['news_tag'] = $temp;
        }
        $detail['pre_and_next']['next'] = $newsModel->where('cid', $detail['cid'])->where('id', '>', $detail['id'])->value('id');
        $detail['pre_and_next']['prev'] = $newsModel->where('cid', $detail['cid'])->where('id', '<', $detail['id'])->value('id');

        return $detail;
    }
}