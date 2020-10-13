<?php


namespace app\admin\controller;


use app\admin\model\LinkModel;
use app\admin\model\MessageModel;
use app\admin\model\PacontentModel;
use app\admin\model\ProductModel;
use app\admin\model\VideoModel;
use app\admin\service\FunctionService;
use app\admin\service\ImgService;
use app\admin\service\SeoService;
use app\admin\service\TagService;
use app\admin\validate\PacontentValidate;
use app\admin\validate\ProductValidate;
use cmf\controller\AdminBaseController;
use think\Db;
use think\db\Query;
use tree\Tree;

class PacontentController extends AdminBaseController
{

    public $type = 6;
    public function initialize()
    {
        parent::initialize();
        $this->assign("type", $this->type);
    }

    public function index(PacontentModel $pacontentModel)
    {
//        $content = hook_one('admin_pacontent_default_view');
//
//        if (!empty($content)) {
//            return $content;
//        }

        /* 查询条件
         * 分类\关键词\中英文\是否显示\
         */

        $tree = new Tree();
        $parentId = $this->request->param("cid", 0, 'intval');
        $result = Db::name('class')->where(["type" => 1])->order(["order_num" => "ASC"])->select();
        $array = [];
        foreach ($result as $r) {
            $r['selected'] = $r['id'] == $parentId ? 'selected' : '';
            $array[] = $r;
        }
        $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);
        $selectClass = $tree->getTree(0, $str);
        $this->assign("selectClass", $selectClass);
        $data = $this->request->param();
        $where = [];
        if (!empty($data['cid'])) {
            $where['cid'] = $data['cid'];
        }
        if (!empty($data['keyword'])) {
            $where['paname'] = $data['keyword'];
        }
        $list = $pacontentModel->with(['PaGetClass'])
            ->where($where)
            ->order("order_num ASC")
            ->paginate(10);
        if (!empty($data['cid'])) {
            $list->appends(['cid' => $data['cid']]);
        }
        if (!empty($data['keyword'])) {
            $list->appends(['keyword' => $data['keyword']]);
        }
        // 获取分页显示
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
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
        $parentId = $this->request->param("parent_id", 0, 'intval');
        $data = $this->request->param();
        $order_num = $FunctionService->get_order_num('product');
        $result = Db::name('class')->where(["type" => 1])->order(["order_num" => "ASC"])->select();
        $array = [];
        foreach ($result as $r) {
            $r['selected'] = $r['id'] == $parentId ? 'selected' : '';
            $array[] = $r;
        }
        $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);
        $selectClass = $tree->getTree(0, $str);
        $this->assign("selectClass", $selectClass);
        $this->assign("order_num", $order_num);
        return $this->fetch();
    }


    public function addPost(PacontentModel $pacontentModel, PacontentValidate $pacontentValidate, ImgService $imgService, TagService $tagService, SeoService $seoService)
    {
        $data = $this->request->param();
        $result = $this->validate($data, 'Pacontent.add');
        if ($result !== true) {
            $this->error($result);
        }
        Db::transaction(function () use ($pacontentModel, $imgService, $tagService, $seoService, $data) {
            $pacontentModel->allowField(true)->save($data);
            if (isset($data['img_list'])) {
                $imgService->doSave($data['img_list'], $data['type'], $pacontentModel->id);
            }
            if ($data['tag_id']) {
                $tagService->doSave($data['tag_id'], $data['type'], $pacontentModel->id);
            }
            if (!$data['is_auto_seo']) {
                $seoService->dosave($data, $data['type'], $pacontentModel->id);
            }
        });
        $this->success("添加成功！", url("Pacontent/index", ['type' => $this->type]));
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

        $pacontent = DB::name('pacontent')->where("id", $id)->find();


        $this->assign("pacontent", $pacontent);
        $paclass = DB::name('class')->where(['id' => $pacontent['cid']])->find();

        $tree = new Tree();
        if ($paclass['parent_id'] == 0) {
            $parentId = $paclass['id'];
        } else {
            $parentId = $paclass['parent_id'];
        }

        $result = Db::name('class')->where(["type" => 1])->order(["order_num" => "ASC"])->select();
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
        $role_ids = DB::name('class')->column("id");
        $this->assign("role_ids", $role_ids);

        return $this->fetch();
    }


    public function editPost(PacontentModel $pacontentModel)
    {
        if ($this->request->isPost()) {

            $data = $this->request->param();

            $isFindPas = DB::name('pacontent')->where(['paname' => $data['paname'], 'lang' => $data['lang']])->all();

            foreach ($isFindPas as $findPa) {
                if ($findPa['id'] != $data['id']) {
                    if ($data['lang'] == 0) {
                        $lang = "英文";
                    } else {
                        $lang = "中文";
                    }
                    $this->error("此标题在" . $lang . "已存在");
                }
            }
//            if($isFindPa){
//                if($data['lang'] == 0){
//                    $lang = "英文";
//                }else{
//                    $lang = "中文";
//                }
//                $this->error("此标题在".$lang."已存在");
//            }

            $result = $this->validate($this->request->param(), 'Pacontent.edit');

            if ($result !== true) {
                // 验证失败 输出错误信息
                $this->error($result);
            } else {
                $result = DB::name('pacontent')->update($_POST);
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

    public function deleteAll(PacontentModel $pacontentModel){
        parent::deleteAlls($pacontentModel);
        $this->success('删除成功！');
    }


}