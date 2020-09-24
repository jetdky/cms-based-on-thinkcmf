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

    public function index(ClassModel $classModel)
    {
        //        $content = hook_one('admin_pacontent_default_view');
        //
        //        if (!empty($content)) {
        //            return $content;
        //        }

        $data = $this->request->param();
        $where = [];
        if (!empty($data['keyword'])) {
            $where[] = array('name', 'like', '%' . $data['keyword'] . '%');
            $this->assign('keyword', $data['keyword']);
        }

        $pList = $classModel->where(['type' => $data['type'], 'parent_id' => 0])->order("list_order ASC")->select()->toArray();
        $list = $classModel->where(['type' => $data['type']])->where($where)->order("list_order ASC")->select()->toArray();
        $arrayClass = [];
        $key = 0;
        foreach ($pList as $pk => $pv) {
            $arrayClass[$key] = $pv;
            $key++;
            foreach ($list as $k => $v) {
                if ($pv['id'] == $v['parent_id']) {
                    $v['name'] = '|-----' . $v['name'];
                    $arrayClass[$key] = $v;
                    $key++;
                }
            }
        }

        //        var_dump($arrayClass);die;
        // 获取分页显示
        //        $page = $list->render();
        $this->assign('arrayClass', $arrayClass);
        $this->assign('type', $data['type']);
        //        dump($list->items()[0]);die;
        //        $this->assign('page', $page);
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

    public function indexPacontent(ClassModel $classModel)
    {
        //        $content = hook_one('admin_pacontent_default_view');
        //
        //        if (!empty($content)) {
        //            return $content;
        //        }
        $data = $this->request->param();

        $pList = $classModel->where(['type' => $data['type'], 'parent_id' => 0])->order("list_order ASC")->select()->toArray();
        $list = $classModel->where(['type' => $data['type']])->order("list_order ASC")->select()->toArray();
        $arrayClass = [];
        $key = 0;
        foreach ($pList as $pk => $pv) {
            $arrayClass[$key] = $pv;
            $key++;
            foreach ($list as $k => $v) {
                if ($pv['id'] == $v['parent_id']) {
                    $v['name'] = '|-----' . $v['name'];
                    $arrayClass[$key] = $v;
                    $key++;
                }
            }
        }

        //        var_dump($arrayClass);die;
        // 获取分页显示
        //        $page = $list->render();
        $this->assign('arrayClass', $arrayClass);
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

    public function indexNews(ClassModel $classModel)
    {
        //        $content = hook_one('admin_pacontent_default_view');
        //
        //        if (!empty($content)) {
        //            return $content;
        //        }
        $data = $this->request->param();

        $pList = $classModel->where(['type' => $data['type'], 'parent_id' => 0])->order("list_order ASC")->select()->toArray();
        $list = $classModel->where(['type' => $data['type']])->order("list_order ASC")->select()->toArray();
        $arrayClass = [];
        $key = 0;
        foreach ($pList as $pk => $pv) {
            $arrayClass[$key] = $pv;
            $key++;
            foreach ($list as $k => $v) {
                if ($pv['id'] == $v['parent_id']) {
                    $v['name'] = '|-----' . $v['name'];
                    $arrayClass[$key] = $v;
                    $key++;
                }
            }
        }

        //        var_dump($arrayClass);die;
        // 获取分页显示
        //        $page = $list->render();
        $this->assign('arrayClass', $arrayClass);
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

    public function indexProduct(ClassModel $classModel)
    {
        //        $content = hook_one('admin_pacontent_default_view');
        //
        //        if (!empty($content)) {
        //            return $content;
        //        }
        $data = $this->request->param();
        $pList = $classModel->where(['type' => $data['type'], 'parent_id' => 0])->order("list_order ASC")->select()->toArray();
        $list = $classModel->where(['type' => $data['type']])->order("list_order ASC")->select()->toArray();
        $arrayClass = [];
        $key = 0;
        foreach ($pList as $pk => $pv) {
            $arrayClass[$key] = $pv;
            $key++;
            foreach ($list as $k => $v) {
                if ($pv['id'] == $v['parent_id']) {
                    $v['name'] = '|-----' . $v['name'];
                    $arrayClass[$key] = $v;
                    $key++;
                }
            }
        }

        //        var_dump($arrayClass);die;
        // 获取分页显示
        //        $page = $list->render();
        $this->assign('arrayClass', $arrayClass);
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
        $result = Db::name('class')->where(["type" => $data])->order(["list_order" => "ASC"])->select();
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
        $parentClass = ClassModel::get($data['parent_id']);

        if ($parentClass['parent_id'] != 0) {
            $this->error('只支持二级分类');
        }
        $isFindPa = ClassModel::where(['name' => $data['name'], 'lang' => $data['lang']])->find();

        if ($isFindPa) {
            if ($data['lang'] == 0) {
                $lang = "英文";
            } else {
                $lang = "中文";
            }
            $this->error("此分类在" . $lang . "已存在");
        }
        //        $linkModel = new P();
        //        $pacontentValidate->with('add')->check($data);
        //        var_dump($data);die;
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
    public function edit()
    {
        $content = hook_one('admin_pacontent_edit_view');
        if (!empty($content)) {
            return $content;
        }

        $id = $this->request->param('id', 0, 'intval');
        $this->assign('id', $id);
        $data = $this->request->param();
        $classinfo = DB::name('class')->where("id", $id)->find();
        //获得分类下其他信息（关联图片，seo，标签）
        $imgService = new ImgService();
        $tagService = new TagService();
        $classinfo['imgs'] = $imgService->read($data['id'], $classinfo['type']);
        $classinfo['tags'] = $tagService->read($data['id'], $classinfo['type']);
        halt($classinfo);
        $this->assign("classinfo", $classinfo);
        //        $paclass = DB::name('class')->where(['id'=>$classinfo['id']])->find();

        $tree = new Tree();
        if ($classinfo['parent_id'] == 0) {
            $parentId = $classinfo['id'];
        } else {
            $parentId = $classinfo['parent_id'];
        }

        $result = Db::name('class')->where(["type" => $data])->order(["list_order" => "ASC"])->select();
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


    public function editPost(PacontentModel $pacontentModel)
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
                $result = DB::name('class')->update($_POST);
                if ($result !== false) {
                    $this->success("保存成功！");
                } else {
                    $this->error("保存失败！");
                }
            }
        }
    }


    public function delete()
    {
        $id = $this->request->param('id', 0, 'intval');
        $ifParentClass = Db::name('class')->where(['parent_id' => $id])->count();
        if ($ifParentClass) {
            $this->error("此类拥有子类，删除失败！");
        }
        if (Db::name('class')->delete($id) !== false) {
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
     * 启用
     */
    public function cancelBan()
    {
        $id = $this->request->param('id', 0, 'intval');
        $type = $this->request->param('type', 0, 'intval');
        if (!empty($id)) {
            $result = Db::name('class')->where(["id" => $id])->setField('status', '1');
            if ($result !== false) {
                $this->success("内容启用成功！", url("Class/index", ['type' => $type]));
            } else {
                $this->error('内容启用失败！');
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

    public function indexVideo(ClassModel $classModel)
    {
        //        $content = hook_one('admin_pacontent_default_view');
        //
        //        if (!empty($content)) {
        //            return $content;
        //        }
        $data = $this->request->param();

        $pList = $classModel->where(['type' => $data['type'], 'parent_id' => 0])->order("list_order ASC")->select()->toArray();
        $list = $classModel->where(['type' => $data['type']])->order("list_order ASC")->select()->toArray();
        $arrayClass = [];
        $key = 0;
        foreach ($pList as $pk => $pv) {
            $arrayClass[$key] = $pv;
            $key++;
            foreach ($list as $k => $v) {
                if ($pv['id'] == $v['parent_id']) {
                    $v['name'] = '|-----' . $v['name'];
                    $arrayClass[$key] = $v;
                    $key++;
                }
            }
        }

        //        var_dump($arrayClass);die;
        // 获取分页显示
        //        $page = $list->render();
        $this->assign('arrayClass', $arrayClass);
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
}
