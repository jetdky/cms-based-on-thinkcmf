<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2019 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +---------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace cmf\controller;

use think\Container;
use think\Controller;
use think\Db;
use think\facade\View;
use think\facade\Config;

class BaseController extends Controller
{
    /**
     * BaseController constructor.
     */
    public function __construct()
    {
        $this->app     = Container::get('app');
        $this->request = $this->app['request'];

        if (!cmf_is_installed() && $this->request->module() != 'install') {
            return $this->redirect(cmf_get_root() . '/?s=install');
        }

        $this->_initializeView();
        $this->view = View::init(Config::get('template.'));

        // 控制器初始化
        $this->initialize();

        // 前置操作方法 即将废弃
        foreach ((array)$this->beforeActionList as $method => $options) {
            is_numeric($method) ?
                $this->beforeAction($options) :
                $this->beforeAction($method, $options);
        }

    }


    // 初始化视图配置
    protected function _initializeView()
    {
    }

    /**
     *  排序 排序字段为order_nums数组 POST 排序字段为：order_num
     */
    protected function listOrders($model)
    {
        $modelName = '';
        if (is_object($model)) {
            $modelName = $model->getName();
        } else {
            $modelName = $model;
        }

        $pk  = Db::name($modelName)->getPk(); //获取主键名称
        $ids = $this->request->post("order_nums/a");

        if (!empty($ids)) {
            foreach ($ids as $key => $r) {
                $data['order_num'] = $r;
                Db::name($modelName)->where($pk, $key)->update($data);
            }
        }

        return true;
    }

    /**
     *  排序 排序字段为order_nums数组 POST 排序字段为：order_num
     */
    protected function deleteAlls($model)
    {
        $ids = $this->request->post("order_nums/a");
        $ids = array_keys($ids);
        $ids = implode(',',$ids);
        $model::destroy($ids);
        return true;
    }

}