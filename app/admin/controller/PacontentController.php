<?php


namespace app\admin\controller;


use app\common\model\ClassModel;
use app\common\model\ImgContentModel;
use app\common\model\LinkModel;
use app\common\model\MessageModel;
use app\common\model\PacontentModel;
use app\common\model\ProductModel;
use app\common\model\TagContentModel;
use app\common\model\VideoModel;
use app\admin\service\FunctionService;
use app\admin\service\ImgService;
use app\admin\service\SeoService;
use app\admin\service\TagService;
use app\admin\validate\PacontentValidate;
use cmf\controller\AdminBaseController;
use think\Db;
use think\db\Query;
use tree\Tree;

class PacontentController extends AdminBaseController
{

    public $type = 5;
    public $categoryType = 1;

    public function initialize()
    {
        parent::initialize();
        $this->assign("type", $this->type);
    }

    public function index(PacontentModel $pacontentModel)
    {

        $tree = new Tree();
        $array = [];

        $data = $this->request->param();
        $where = [];
        $whereSearch = [];
        if (isset($data['lang']) && $data['lang'] !== "") {
            $whereSearch[] = ['lang', '=', $data['lang']];
            $this->assign('lang', $data['lang']);
        }
        $result = Db::name('class')->where(["type" => $this->categoryType])->where($whereSearch)->order(["order_num" => "ASC"])->select();
        if (isset($data['cid']) && $data['cid'] !== "") {
            $sonCategory = build_category_tree($result, $data['cid']);
            $sonCategoryId = [];
            foreach ($sonCategory as $value) {
                $sonCategoryId[] = $value['id'];
            }
            $sonCategoryId[] = $data['cid'];
            $where[] = ['cid', 'IN', $sonCategoryId];
            $parentId = $data['cid'];
        } else {
            $parentId = 0;
        }

        //根据上次搜索分类选中分类
        foreach ($result as $r) {
            $r['selected'] = $r['id'] == $parentId ? 'selected' : '';
            $array[] = $r;
        }
        $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);
        $selectClass = $tree->getTree(0, $str);

        if (isset($data['status']) && $data['status'] !== "") {
            $where[] = ['status', '=', $data['status']];
            $this->assign('status', $data['status']);
        }
        if (isset($data['is_recom']) && $data['is_recom'] !== "") {
            $where[] = ['is_recom', '=', $data['is_recom']];
            $this->assign('is_recom', $data['is_recom']);
        }
        if (isset($data['lang']) && $data['lang'] !== "") {
            $where[] = ['lang', '=', $data['lang']];
            $whereSearch[] = ['lang', '=', $data['lang']];
            $this->assign('lang', $data['lang']);
        }
        $list = $pacontentModel->where($where)
            ->with(['pacontentImg', 'pacontentImg.imgs', 'paGetClass'])
            ->order("order_num ASC")->paginate(20, false, ['query' => $data]);
        // 获取分页显示
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        $this->assign("selectClass", $selectClass);
        // 渲染模板输出
        return $this->fetch();
    }

    /*
     * 添加内容
     *
     *
     *
     * **/
    public function add(FunctionService $FunctionService)
    {
        $tree = new Tree();
        $data = $this->request->param();
        $parentId = @$data['cid'] ?: 0;
        $order_num = $FunctionService->get_order_num('Pacontent');
        $result = Db::name('class')->where(["type" => $this->categoryType])->order(["order_num" => "ASC"])->select();
        $array = [];
        foreach ($result as $r) {
            $r['selected'] = $r['id'] == $parentId ? 'selected' : '';
            $array[] = $r;
        }
        $str = "<option lang='\$lang' value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);
        $selectClass = $tree->getTree(0, $str);
        $this->assign("selectClass", $selectClass);
        $this->assign("order_num", $order_num);
        $this->assign("lang", @$data['lang'] ?: 1);
        return $this->fetch();
    }


    public function addPost(PacontentModel $pacontentModel, PacontentValidate $pacontentValidate, ImgService $imgService)
    {
        $data = $this->request->param();
        $result = $this->validate($data, 'Pacontent.add');
        if ($result !== true) {
            $this->error($result);
        }
        Db::transaction(function () use ($pacontentModel, $imgService, $data) {
            $pacontentModel->allowField(true)->save($data);
            if (isset($data['img_list'])) {
                $imgService->doSave($data['img_list'], $data['type'], $pacontentModel->id);
            }
        });
        $this->success("添加成功！", url("Pacontent/add", ['type' => $this->type, 'cid' => $data['cid'], 'lang' => $data['lang']]));
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
    public function edit(PacontentModel $pacontentModel)
    {

        $id = $this->request->param('id', 0, 'intval');
        $this->assign('id', $id);
        $pacontent = $pacontentModel->where("id", $id)->find();
        $paclass = DB::name('class')->where(['id' => $pacontent['cid']])->find();

        $tree = new Tree();
        $parentId = $paclass['id'];

        $imgService = new ImgService();
        $pacontent['imgs'] = $imgService->read($id, $this->type);
        $result = Db::name('class')->where(["type" => $this->categoryType])->order(["order_num" => "ASC"])->select();
        $array = [];
        foreach ($result as $r) {
            $r['selected'] = $r['id'] == $parentId ? 'selected' : '';
            $array[] = $r;
        }
        $str = "<option lang='\$lang' value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);
        $selectClass = $tree->getTree(0, $str);
        $this->assign("selectClass", $selectClass);
        $this->assign("pacontent", $pacontent);

        return $this->fetch();
    }


    public function editPost(PacontentModel $pacontentModel, ImgService $imgService, TagService $tagService, SeoService $seoService)
    {
        if ($this->request->isPost()) {
            $data = $this->request->param();
            $result = true;
            if ($result !== true) {
                // 验证失败 输出错误信息
                $this->error($result);
            } else {
                Db::transaction(function () use ($pacontentModel, $imgService, $tagService, $seoService, $data) {
                    if (isset($data['img_list'])) {
                        $imgService->delete($data['id'], $data['type']);
                        $imgService->doSave($data['img_list'], $data['type'], $data['id']);
                    } else {
                        $imgService->delete($data['id'], $data['type']);
                    }
                    $result = $pacontentModel->allowField(true)->update($data);
                });

                if ($result !== false) {
                    $this->success("保存成功！", url("Pacontent/index", ['type' => $data['type']]));
                } else {
                    $this->error("保存失败！");
                }
            }
        }
    }


    public function delete()
    {
        $id = $this->request->param('id', 0, 'intval');
        if (Db::name('pacontent')->delete($id) !== false) {
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
        if (!empty($id)) {
            $result = Db::name('pacontent')->where(["id" => $id])->setField('status', '0');
            if ($result !== false) {
                $this->success("内容停用成功！", url("Pacontent/index"));
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
        if (!empty($id)) {
            $result = Db::name('pacontent')->where(["id" => $id])->setField('status', '1');
            if ($result !== false) {
                $this->success("内容显示成功！", url("Pacontent/index"));
            } else {
                $this->error('内容显示失败！');
            }
        } else {
            $this->error('数据传入失败！');
        }
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

    /**
     * @param PacontentModel $pacontentModel
     * 批量删除
     */

    public function deleteAll(PacontentModel $pacontentModel)
    {
        parent::deleteAlls($pacontentModel);
        $this->success('删除成功！');
    }

    /**推荐&&取消推荐
     * @param PacontentModel $pacontentModel
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function recom(PacontentModel $pacontentModel)
    {
        $data = $this->request->param();
        $pacontentModel->where('id', $data['id'])->update(['is_recom' => 1]);
        $this->success('推荐成功！');
    }

    public function cancelRecom(PacontentModel $pacontentModel)
    {
        $data = $this->request->param();
        $pacontentModel->where('id', $data['id'])->update(['is_recom' => 0]);
        $this->success('取消推荐成功！');
    }

    /**
     * ajax 获取class列表用于批量移动和复制
     * @param
     */
    public function getClassList(ClassModel $classModel)
    {
        $tree = new Tree();
        $result = $classModel->where(['type' => $this->categoryType])->order("order_num ASC")->select()->toArray();

        $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($result);
        $list = $tree->getTree(0, $str);
        return json_encode($list);
    }

    /**
     * ajax 移动数据
     * @param
     */
    public function saveMove()
    {
        $data = $this->request->param();
        $id_array = explode(',', $data['id']);
        Db::name('pacontent')->whereIn('id', $id_array)->update(['cid' => $data['cid'], 'lang' => $data['lang']]);
        return true;
    }

    /**
     * ajax 批量复制
     * @param
     */
    public function saveCopy(PacontentModel $pacontentModel, ImgContentModel $imgContentModel, TagContentModel $tagContentModel)
    {
        $data = $this->request->param();
        $id_array = explode(',', $data['id']);
        $pacontentData = $pacontentModel->whereIn('id', $id_array)->select()->toArray();
        foreach ($pacontentData as $k => $v) {
            $imgs = $imgContentModel->where(['content_id' => $v['id'], 'type' => $this->type])->select()->toArray();
            $tags = $tagContentModel->where(['content_id' => $v['id'], 'type' => $this->type])->select()->toArray();
            unset($v['id']);
            $v['cid'] = $data['cid'];
            $v['lang'] = $data['lang'];
            $pacontentModel->isUpdate(false)->data($v, true)->save($v);
            $id = $pacontentModel->id;
            if (!empty($imgs)) {
                $b = [];
                foreach ($imgs as $vimg) {
                    unset($vimg['id']);
                    $vimg['content_id'] = $id;
                    $b[] = $vimg;
                }
                $imgContentModel->saveAll($b);
            }
            if (!empty($tags)) {
                $c = [];
                foreach ($tags as $vimg) {
                    unset($vimg['id']);
                    $vimg['content_id'] = $id;
                    $c[] = $vimg;
//                    $imgContentModel->save($vimg);
                }
                $tagContentModel->saveAll($c);
            }
        }
        return true;
    }
}