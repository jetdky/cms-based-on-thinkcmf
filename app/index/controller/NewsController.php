<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Released under the MIT License.
// +----------------------------------------------------------------------
// | Author: 老猫 <thinkcmf@126.com>
// +----------------------------------------------------------------------

namespace app\index\controller;

use app\admin\model\NewsModel;
use cmf\controller\HomeBaseController;

class NewsController extends HomeBaseController
{
    public function index(NewsModel $newsModel)
    {
        //  根据新闻分类id获取新闻列表
//        $param = $this->request['param'];
        $param['cid'] = 8;
        $where = [];
        if (!empty($param['cid'])) {
            $where['cid'] = $param['cid'];
        }
//        $where['lang'] = $param['lang'];
        $where['lang'] = 1;
        $list = $newsModel->where($where)
            ->with(['newsImg', 'newsImg.imgs', 'newsClass'])
            ->order("order_num ASC")->paginate(10, false);
      $this->assign('newsList',$list);
        return $this->fetch();
    }

    public function info(NewsModel $newsModel)
    {
        //  根据新闻id获取新闻详情
//        $param = $this->request['param'];
        $param['id'] = 10;
        $news = $newsModel->with(['newsImg', 'newsImg.imgs', 'newsClass'])->find($param['id']);

        //  下一页
        $prov = $newsModel->where('id','>' ,$param['id'])
            ->with(['newsImg', 'newsImg.imgs', 'newsClass'])
            ->order("order_num ASC")->paginate(1, false)->toArray();
        //  下一页
        $next = $newsModel->where('id','<' ,$param['id'])
            ->with(['newsImg', 'newsImg.imgs', 'newsClass'])
            ->order("order_num ASC")->paginate(1, false)->toArray();
        $this->assign('prov',$prov);
        $this->assign('next',$next);
        $this->assign('news',$news);
        return $this->fetch();
    }
}
