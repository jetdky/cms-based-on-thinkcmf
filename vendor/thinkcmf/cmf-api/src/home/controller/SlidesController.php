<?php
// +----------------------------------------------------------------------
// | 文件说明：标签库
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: wuwu <15093565100@163.com>
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Date: 2017-5-25
// +----------------------------------------------------------------------
namespace api\home\controller;

use api\home\service\SlideService;
use cmf\controller\RestBaseController;

class SlidesController extends RestBaseController
{
    /**
     * 获取标签库
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function read()
    {
        //slide为空或不存在抛出异常
        $id = $this->request->param('id', 0, 'intval');
        if (empty($id)) {
            $this->error('缺少ID参数');
        }

        $map['id']    = $id;
        $slideService = new SlideService();
        $data         = $slideService->SlideList($map);
        //剔除分类状态隐藏 剔除分类下显示数据为空
        if (empty($data) || $data['items']->isEmpty()) {
            $this->error('该组标签库显示数据为空');
        }

        if (empty($this->apiVersion) || $this->apiVersion == '1.0.0') {
            $response = [$data];
        } else {
            $response = $data;
        }

        $this->success("该组标签库获取成功!", $response);
    }

}
