<?php
// +----------------------------------------------------------------------
// | 文件说明：用户-标签库
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: wuwu <15093565100@163.com>
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Date: 2017-5-25
// +----------------------------------------------------------------------

namespace api\home\model;

use think\Model;

class SlideItemModel extends Model
{
    /**
     * 类型转换
     * @var array
     */
    protected $type = [
        'more' => 'array',
    ];

    /**
     * 全局查询范围status=1显示状态
     *
     * @param $query
     */
    protected function base($query)
    {
        $query->where('status', 1);
    }

    /**
     * image 自动转化
     * @param $value
     * @return array
     */
    public function getImageAttr($value)
    {
        return cmf_get_image_url($value);
    }
}

