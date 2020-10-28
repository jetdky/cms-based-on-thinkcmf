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
use app\admin\model\VideoModel;
use think\Controller;

class VideoController extends BaseController
{
    public function index(VideoModel $videoModel)
    {
        //  根据新闻分类id获取新闻列表
//        $param = $this->request['param'];
        $where = [];
        $where['lang'] = 1;
        $list = $videoModel->where($where)
            ->order("order_num ASC")->paginate(10, false)->toArray();
        $this->assign('videoList',$list);
//        var_dump($list);die;
        return $this->fetch();
    }

    public function info(VideoModel $videoModel)
    {
        //  根据新闻id获取新闻详情
//        $param = $this->request['param'];
        $param['id'] = 11;
        $video = $videoModel->find($param['id']);

        //  下一页
        $prov = $videoModel->where('id','>' ,$param['id'])
            ->order("order_num ASC")->paginate(1, false)->toArray();
        //  下一页
        $next = $videoModel->where('id','<' ,$param['id'])
            ->order("order_num ASC")->paginate(1, false)->toArray();
        $this->assign('prov',$prov);
        $this->assign('next',$next);
        $this->assign('video',$video);
        var_dump($prov);die;
        return $this->fetch();
    }
}
