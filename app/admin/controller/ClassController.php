<?php


namespace app\admin\controller;


use app\admin\model\ClassModel;
use app\admin\model\LinkModel;
use app\admin\model\PacontentModel;
use app\admin\validate\ClassValidate;
use app\admin\validate\PacontentValidate;
use cmf\controller\AdminBaseController;
use app\admin\service\ImgService;
use app\admin\service\TagService;
use app\admin\service\SeoService;
use app\admin\service\FunctionService;
use think\Db;
use think\db\Query;
use tree\Tree;

class ClassController extends AdminBaseController
{

    public function index(ClassModel $classModel, ImgService $imgService)
    {
        $data = $this->request->param();
        $where = [];
        if (!empty($data['keyword'])) {
            $where[] = array('name', 'like', '%' . $data['keyword'] . '%');
            $this->assign('keyword', $data['keyword']);
        }

        $list = $classModel->where(['type' => $data['type']])->order("order_num ASC")->select()->toArray();
        $list = build_category_tree($list);

        foreach ($list as $k => $v) {
            if ($v['parent_id'] && $v['level'] == 2) {
                $list[$k]['name'] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $v['level'] - 1) . $v['name'];
            } elseif ($v['parent_id'] && $v['level'] == 3) {
                $list[$k]['name'] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $v['level'] - 1) . $v['name'];
            }
            $list[$k]['imgs'] = $imgService->read($v['id'], $v['type']);
        }

        //获得搜索分类
        $tree = new Tree();
        $parentId = $this->request->param("cid", 0, 'intval');
        $result = Db::name('class')->where(["type" => $data['type']])->order(["order_num" => "ASC"])->select();
        foreach ($result as $r) {
            $r['selected'] = $r['id'] == $parentId ? 'selected' : '';
            $array[] = $r;
        }
        $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);
        $selectClass = $tree->getTree(0, $str);

        // 获取分页显示
        $this->assign('arrayClass', $list);
        $this->assign('selectClass', $selectClass);
        $this->assign('type', $data['type']);
        // 渲染模板输出
        return $this->fetch();
    }

    /**
     * 内容分类
     * @return
     * @throws
     * @throws
     * @throws
     */

    public function indexPacontent(ClassModel $classModel, ImgService $imgService)
    {
        $data = $this->request->param();

        $list = $classModel->where(['type' => $data['type']])->order("order_num ASC")->select()->toArray();
        $list = build_category_tree($list);

        foreach ($list as $k => $v) {
            if ($v['parent_id'] && $v['level'] == 2) {
                $list[$k]['name'] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $v['level'] - 1) . $v['name'];
            } elseif ($v['parent_id'] && $v['level'] == 3) {
                $list[$k]['name'] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $v['level'] - 1) . $v['name'];
            }
            $list[$k]['imgs'] = $imgService->read($v['id'], $v['type']);
        }

        // 获取分页显示
        //        $page = $list->render();
        $this->assign('arrayClass', $list);
        $this->assign('type', $data['type']);
        //        dump($list->items()[0]);die;
        //        $this->assign('page', $page);
        // 渲染模板输出
        return $this->fetch('index');
    }


    /**
     * 新闻分类
     * @return
     * @throws
     * @throws
     * @throws
     */

    public function indexNews(ClassModel $classModel, ImgService $imgService)
    {
        $data = $this->request->param();

        $list = $classModel->where(['type' => $data['type']])->order("order_num ASC")->select()->toArray();
        $list = build_category_tree($list);
        foreach ($list as $k => $v) {
            if ($v['parent_id'] && $v['level'] == 2) {
                $list[$k]['name'] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $v['level'] - 1) . $v['name'];
            }
            $list[$k]['imgs'] = $imgService->read($v['id'], $v['type']);
        }
        //获得搜索分类
        $tree = new Tree();
        $parentId = $this->request->param("cid", 0, 'intval');
        $result = Db::name('class')->where(["type" => $data['type']])->order(["order_num" => "ASC"])->select();
        foreach ($result as $r) {
            $r['selected'] = $r['id'] == $parentId ? 'selected' : '';
            $array[] = $r;
        }
        $str = "<option lang-data='\$lang' value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);
        $selectClass = $tree->getTree(0, $str);

        // 获取分页显示
        //        $page = $list->render();
        $this->assign('arrayClass', $list);

        $this->assign('selectClass', $selectClass);

        $this->assign('type', $data['type']);
        //        dump($list->items()[0]);die;
        //        $this->assign('page', $page);
        // 渲染模板输出
        return $this->fetch('index');
    }

    /**
     * 产品分类
     * @return
     * @throws
     * @throws
     * @throws
     */

    public function indexProduct(ClassModel $classModel, ImgService $imgService)
    {
        $data = $this->request->param();
//        $pList = $classModel->where(['type' => $data['type'], 'parent_id' => 0])->order("order_num ASC")->select()->toArray();

        $list = $classModel->where(['type' => $data['type']])->order("order_num ASC")->select()->toArray();
        $list = build_category_tree($list);

        foreach ($list as $k => $v) {
            if ($v['parent_id'] && $v['level'] == 2) {
                $list[$k]['name'] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $v['level'] - 1) . $v['name'];
            } elseif ($v['parent_id'] && $v['level'] == 3) {
                $list[$k]['name'] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $v['level'] - 1) . $v['name'];
            }
            $list[$k]['imgs'] = $imgService->read($v['id'], $v['type']);
        }

        //        var_dump($arrayClass);die;
        // 获取分页显示
        //        $page = $list->render();
        $this->assign('arrayClass', $list);
//        halt($arrayClass);

        $this->assign('type', $data['type']);
        //        dump($list->items()[0]);die;
        //        $this->assign('page', $page);
        // 渲染模板输出
        return $this->fetch('index');
    }


    /*
     * 添加内容
     *
     *
     *
     * **/
    public function add(FunctionService $FunctionService)
    {
        $data = $this->request->param();
        $order_num = $FunctionService->get_order_num('class', $data['type']);
        $tree = new Tree();
        $parentId = $this->request->param("parent_id", 0, 'intval');
        $result = Db::name('class')->where(["type" => $data])->order(["order_num" => "ASC"])->select();
        $array = [];
        foreach ($result as $r) {
            $r['selected'] = $r['id'] == $parentId ? 'selected' : '';
            $array[] = $r;
        }
        $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);
        $selectClass = $tree->getTree(0, $str);
        $this->assign("selectClass", $selectClass);
        $this->assign("type", $data['type']); //1为内容的分类
        $this->assign('order_num', $order_num);

        return $this->fetch();
    }


    public function addPost(ClassModel $classModel, ClassValidate $classValidate, ImgService $imgService, TagService $tagService, SeoService $seoService)
    {
        $data = $this->request->param();
//        halt($data);
        $result = $this->validate($data, 'Class.add');
        if ($result !== true) {
            $this->error($result);
        }
//        $parentClass = ClassModel::get($data['parent_id']);
//
//        if ($parentClass['parent_id'] != 0) {
//            $this->error('只支持二级分类');
//        }

        Db::transaction(function () use ($classModel, $imgService, $tagService, $seoService, $data) {
            $classModel->allowField(true)->save($data);
            if (isset($data['img_list'])) {
                $imgService->doSave($data['img_list'], $data['type'], $classModel->id);
            }
            if ($data['tag_id']) {
                $tagService->doSave($data['tag_id'], $data['type'], $classModel->id);
            }
            if (!$data['is_auto_seo']) {
                $seoService->dosave($data, $data['type'], $classModel->id);
            }
        });

        $this->success("添加成功！", url("Class/index", ['type' => $data['type']]));
    }

    /**
     * 内容编辑
     * @adminMenu(
     *     'name'   => '内容编辑',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '内容编辑',
     *     'param'  => ''
     * )
     */
    public function edit(ClassModel $classModel)
    {

        $id = $this->request->param('id', 0, 'intval');
        $this->assign('id', $id);
        $data = $this->request->param();
        $classinfo = $classModel->where("id", $id)->find();
        //获得分类下其他信息（关联图片，seo，标签）
        $imgService = new ImgService();
        $seoService = new SeoService();
        $classinfo['imgs'] = $imgService->read($data['id'], $classinfo['type']);
        $classinfo['seo'] = $seoService->read($data['id'], $classinfo['type']);
        $this->assign("classinfo", $classinfo);

        $tree = new Tree();
        if ($classinfo['parent_id'] == 0) {
            $parentId = -1;
        } else {
            $parentId = $classinfo['parent_id'];
        }

        $result = Db::name('class')->where(["type" => $data])->order(["order_num" => "ASC"])->select();
        $array = [];
        foreach ($result as $r) {
            $r['selected'] = $r['id'] == $parentId ? 'selected' : '';
            $array[] = $r;
        }
        $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);
        $selectClass = $tree->getTree(0, $str);
        $this->assign("selectClass", $selectClass);

        $class = DB::name('class')->where('status', 1)->order("id DESC")->select();
        $this->assign("class", $class);
        $this->assign("type", $data['type']);
        $role_ids = DB::name('class')->column("id");
        $this->assign("role_ids", $role_ids);

        return $this->fetch();
    }


    public function editPost(ClassModel $classModel, ClassValidate $classValidate, ImgService $imgService, TagService $tagService, SeoService $seoService)
    {
        if ($this->request->isPost()) {
            $data = $this->request->param();
            $isFindPas = DB::name('class')->where(['name' => $data['name'], 'type' => $data['type'], 'lang' => $data['lang']])->all();

            foreach ($isFindPas as $findPa) {
                if ($findPa['id'] != $data['id']) {
                    if ($data['lang'] == 0) {
                        $lang = "英文";
                    } else {
                        $lang = "中文";
                    }
                    $this->error("此分类在" . $lang . "已存在");
                }
            }

            $result = $this->validate($this->request->param(), 'Class.edit');
            if ($result !== true) {
                // 验证失败 输出错误信息
                $this->error($result);
            } else {
                Db::transaction(function () use ($classModel, $imgService, $tagService, $seoService, $data) {
                    if (isset($data['img_list'])) {
                        $imgService->delete($data['id'], $data['type']);
                        $imgService->doSave($data['img_list'], $data['type'], $data['id']);
                    } else {
                        $imgService->delete($data['id'], $data['type']);
                    }

                    if ($data['tag_id']) {
                        $tagService->delete($data['id'], $data['type']);
                        $tagService->doSave($data['tag_id'], $data['type'], $data['id']);
                    } else {
                        $tagService->delete($data['id'], $data['type']);
                    }

                    if (!$data['is_auto_seo']) {
                        $seoService->delete($data['id'], $data['type']);
                        $seoService->dosave($data, $data['type'], $data['id']);
                    } else {
                        $seoService->delete($data['id'], $data['type']);
                    }
                    $result = $classModel->allowField(true)->update($data);
                });

                if ($result !== false) {
                    $this->success("保存成功！", url("Class/index", ['type' => $data['type']]));
                } else {
                    $this->error("保存失败！");
                }
            }
        }
    }


    public function delete(ImgService $imgService, TagService $tagService, SeoService $seoService)
    {
        $id = $this->request->param('id', 0, 'intval');
        $typeId = $this->request->param('type', 0, 'intval');
        $result = false;
        $ifParentClass = Db::name('class')->where(['parent_id' => $id])->count();
        if ($ifParentClass) {
            $this->error("此类拥有子类，删除失败！");
        }
        Db::transaction(function () use ($imgService, $tagService, $seoService, $id, $typeId) {
            @$imgService->delete($id, $typeId);
            @$tagService->delete($id, $typeId);
            @$seoService->delete($id, $typeId);
        });
        if (Db::name('class')->where('id', $id)->where('type', $typeId)->delete() !== false) {
            $this->success("删除成功！");
        } else {
            $this->error("删除失败！");
        }
    }

    /**
     * 停用
     */
    public function ban()
    {

        $id = $this->request->param('id', 0, 'intval');
        $type = $this->request->param('type', 0, 'intval');
        if (!empty($id)) {
            $result = Db::name('class')->where(["id" => $id])->setField('status', '0');
            if ($result !== false) {
                $this->success("内容停用成功！", url("Class/index", ['type' => $type]));
            } else {
                $this->error('内容停用失败！');
            }
        } else {
            $this->error('数据传入失败！');
        }
    }

    /**
     * 显示
     */
    public function cancelBan()
    {
        $id = $this->request->param('id', 0, 'intval');
        $type = $this->request->param('type', 0, 'intval');
        if (!empty($id)) {
            $result = Db::name('class')->where(["id" => $id])->setField('status', '1');
            if ($result !== false) {
                $this->success("内容显示成功！", url("Class/index", ['type' => $type]));
            } else {
                $this->error('内容显示失败！');
            }
        } else {
            $this->error('数据传入失败！');
        }
    }

    /**
     * 视频分类
     * @return
     * @throws
     * @throws
     * @throws
     */

    public function indexVideo(ClassModel $classModel, ImgService $imgService)
    {
        //        $content = hook_one('admin_pacontent_default_view');
        //
        //        if (!empty($content)) {
        //            return $content;
        //        }
        $data = $this->request->param();

        $list = $classModel->where(['type' => $data['type']])->order("order_num ASC")->select()->toArray();
        $list = build_category_tree($list);

        foreach ($list as $k => $v) {
            if ($v['parent_id'] && $v['level'] == 2) {
                $list[$k]['name'] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $v['level'] - 1) . $v['name'];
            } elseif ($v['parent_id'] && $v['level'] == 3) {
                $list[$k]['name'] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $v['level'] - 1) . $v['name'];
            }
            $list[$k]['imgs'] = $imgService->read($v['id'], $v['type']);
        }

        // 获取分页显示
        //        $page = $list->render();
        $this->assign('arrayClass', $list);
        $this->assign('type', $data['type']);
        //        dump($list->items()[0]);die;
        //        $this->assign('page', $page);
        // 渲染模板输出
        return $this->fetch('index');
    }

    public function listOrder(PacontentModel $pacontentModel)
    {
        parent::listOrders($pacontentModel);
        $this->success("排序更新成功！");
    }

    /**
     * 友情链接显示隐藏
     * @adminMenu(
     *     'name'   => '友情链接显示隐藏',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '友情链接显示隐藏',
     *     'param'  => ''
     * )
     */
    public function toggle(PacontentModel $pacontentModel)
    {
        $data = $this->request->param();

        if (isset($data['ids']) && !empty($data["display"])) {
            $ids = $this->request->param('ids/a');
            $pacontentModel->where('id', 'in', $ids)->update(['status' => 1]);
            $this->success("更新成功！");
        }

        if (isset($data['ids']) && !empty($data["hide"])) {
            $ids = $this->request->param('ids/a');
            $pacontentModel->where('id', 'in', $ids)->update(['status' => 0]);
            $this->success("更新成功！");
        }
    }


    //一维数组
    public function toLevel($cate, $delimiter = '———', $parent_id = 0, $level = 0)
    {

        $arr = array();
        foreach ($cate as $v) {
            if ($v['parent_id'] == $parent_id) {
                $v['level'] = $level + 1;
                //                $v['delimiter'] = str_repeat($delimiter, $level);
                $arr[] = $v;
                $arr = array_merge($arr, $this->toLevel($cate, $delimiter, $v['id'], $v['level']));
            }
        }
        return $arr;
    }

    /**推荐&&取消推荐
     * @param ClassModel $classModel
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function recom(ClassModel $classModel)
    {
        $data = $this->request->param();
        $classModel->where('id', $data['id'])->update(['is_recom' => 1]);
        $this->success('推荐成功！');
    }

    public function cancelRecom(ClassModel $classModel)
    {
        $data = $this->request->param();
        $classModel->where('id', $data['id'])->update(['is_recom' => 0]);
        $this->success('取消推荐成功！');
    }
}
