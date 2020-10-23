<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2019 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: kane <chengjin005@163.com> 小夏 < 449134904@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use app\admin\model\UserNavModel;
use think\Db;
use tree\Tree;

/**
 * Class NavController 导航类别管理控制器
 * @package app\admin\controller
 */
class NavController extends AdminBaseController
{
    /**
     * 导航管理
     * @adminMenu(
     *     'name'   => '导航管理',
     *     'parent' => 'admin/Setting/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 30,
     *     'icon'   => '',
     *     'remark' => '导航管理',
     *     'param'  => ''
     * )
     */
    public function index()
    {
        $content = hook_one('admin_nav_index_view');

        if (!empty($content)) {
            return $content;
        }

        $navModel = new UserNavModel();
        $navs = $navModel->select();
        $navs = build_category_tree($navs);
        foreach ($navs as $k => $v) {
            if ($v['parent_id'] && $v['level'] >= 2) {
                $navs[$k]['name'] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $v['level'] - 1) . $v['name'];
            }
        }

        $this->assign('navs', $navs);

        return $this->fetch();

    }

    /**
     * 添加导航
     * @adminMenu(
     *     'name'   => '添加导航',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加导航',
     *     'param'  => ''
     * )
     */
    public function add()
    {
        //获得所有分类用于填写
        $navModel = new UserNavModel();
        $navs = $navModel->select();
        $navs = build_category_tree($navs);
        foreach ($navs as $k => $v) {
            if ($v['parent_id'] && $v['level'] >= 2) {
                $navs[$k]['name'] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $v['level'] - 1) . $v['name'];
            }
        }

        $this->assign('navs', $navs);

        return $this->fetch();
    }

    /**
     * 添加导航提交保存
     * @adminMenu(
     *     'name'   => '添加导航提交保存',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加导航提交保存',
     *     'param'  => ''
     * )
     */
    public function addPost()
    {

        $navModel = new UserNavModel();
        $arrData  = $this->request->post();

        $navModel->allowField(true)->insert($arrData);
        $this->success(lang("EDIT_SUCCESS"), url("nav/index"));

    }

    /**
     * 编辑导航
     * @adminMenu(
     *     'name'   => '编辑导航',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑导航',
     *     'param'  => ''
     * )
     */
    public function edit()
    {
        $navModel = new UserNavModel();
        $intId    = $this->request->param("id", 0, 'intval');

        $objNavCat = $navModel->where("id", $intId)->find();
        $arrNavCat = $objNavCat ? $objNavCat->toArray() : [];

        $navs = $navModel->select();
        $navs = build_category_tree($navs);
        foreach ($navs as $k => $v) {
            if ($v['parent_id'] && $v['level'] >= 2) {
                $navs[$k]['name'] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $v['level'] - 1) . $v['name'];
            }
        }

        $this->assign('navs', $navs);
        $this->assign($arrNavCat);
        return $this->fetch();
    }


    /**
     * 编辑导航提交保存
     * @adminMenu(
     *     'name'   => '编辑导航提交保存',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑导航提交保存',
     *     'param'  => ''
     * )
     */
    public function editPost()
    {

        $navModel = new UserNavModel();
        $arrData  = $this->request->post();
        $navModel->allowField(true)->where("id", intval($arrData["id"]))->update($arrData);
        $this->success(lang("EDIT_SUCCESS"), url("nav/index"));

    }

    /**
     * 删除导航
     * @adminMenu(
     *     'name'   => '删除导航',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '删除导航',
     *     'param'  => ''
     * )
     */
    public function delete()
    {
        $navModel = new UserNavModel();
        $intId    = $this->request->param("id", 0, "intval");

        if (empty($intId)) {
            $this->error(lang("NO_ID"));
        }

        $navModel->where("id", $intId)->delete();
        $this->success(lang("DELETE_SUCCESS"), url("nav/index"));

    }


}