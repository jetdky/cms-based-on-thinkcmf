<?php


namespace app\admin\controller;


use app\admin\model\NewsModel;
use app\admin\model\PacontentModel;
use app\admin\service\FunctionService;
use app\admin\service\ImgService;
use app\admin\service\SeoService;
use app\admin\service\TagService;
use app\admin\validate\NewsValidate;
use cmf\controller\AdminBaseController;
use think\Db;
use think\db\Query;
use tree\Tree;

class NewsController extends AdminBaseController
{

    public $type = 6;

    public function initialize()
    {
        parent::initialize();
        $this->assign("type", $this->type);
    }

    public function index(NewsModel $newsModel)
    {
        $tree = new Tree();
        $result = Db::name('class')->where(["type" => 2])->order(["order_num" => "ASC"])->select();
        $array = [];

        $data = $this->request->param();
        $where = [];
        if (isset($data['keyword']) && $data['keyword'] !== "") {
            $where[] = ['name', 'like', '%' . $data['keyword'] . '%'];
            $this->assign('keyword', $data['keyword']);
        }
        if (isset($data['cid']) && $data['cid'] !== "") {
            $where[] = ['cid', '=', $data['cid']];
            $parentId = $data['cid'];
            //todo: 根据父类id获得所有子类id，当前只查询一级父类
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
        $list = $newsModel->where($where)
            ->with(['newsImg', 'newsImg.imgs', 'newsClass'])
            ->order("order_num ASC")->paginate(10, false, ['query' => $data]);

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
        $parentId = $this->request->param("parent_id", 0, 'intval');
        $data = $this->request->param();
        $result = Db::name('class')->where(["type" => 2])->order(["order_num" => "ASC"])->select();
        $order_num = $FunctionService->get_order_num('news');
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


    public function addPost(NewsModel $newsModel, NewsValidate $newsValidate, ImgService $imgService, TagService $tagService, SeoService $seoService)
    {
        $data = $this->request->param();
        $data['show_time'] = str_replace('T', ' ', $data['show_time']);
        $result = $this->validate($data, 'News.add');
        if ($result !== true) {
            $this->error($result);
        }
        Db::transaction(function () use ($newsModel, $imgService, $tagService, $seoService, $data) {
            $newsModel->allowField(true)->save($data);
            if (isset($data['img_list'])) {
                $imgService->doSave($data['img_list'], $data['type'], $newsModel->id);
            }
            if ($data['tag_id']) {
                $tagService->doSave($data['tag_id'], $data['type'], $newsModel->id);
            }
            if (!$data['is_auto_seo']) {
                $seoService->dosave($data, $data['type'], $newsModel->id);
            }
        });
        $this->success("添加成功！", url("News/index", ['type' => $this->type]));
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

        $news = DB::name('news')->where("id", $id)->find();


        $this->assign("news", $news);
        $paclass = DB::name('class')->where(['id' => $news['cid']])->find();

        $tree = new Tree();
        if ($paclass['parent_id'] == 0) {
            $parentId = $paclass['id'];
        } else {
            $parentId = $paclass['parent_id'];
        }

        $result = Db::name('class')->where(["type" => 2])->order(["order_num" => "ASC"])->select();
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


    public function editPost(NewsModel $newsModel)
    {
        if ($this->request->isPost()) {

            $data = $this->request->param();

            $isFindNews = DB::name('news')->where(['title' => $data['title'], 'lang' => $data['lang']])->all();

            foreach ($isFindNews as $findNew) {
                if ($findNew['id'] != $data['id']) {
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

            $result = $this->validate($this->request->param(), 'news.edit');

            if ($result !== true) {
                // 验证失败 输出错误信息
                $this->error($result);
            } else {
                $result = DB::name('news')->update($_POST);
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
        if (Db::name('news')->delete($id) !== false) {
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
            $result = Db::name('news')->where(["id" => $id])->setField('status', '0');
            if ($result !== false) {
                $this->success("内容停用成功！", url("news/index"));
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
            $result = Db::name('news')->where(["id" => $id])->setField('status', '1');
            if ($result !== false) {
                $this->success("内容显示成功！", url("news/index"));
            } else {
                $this->error('内容显示失败！');
            }
        } else {
            $this->error('数据传入失败！');
        }
    }


    public function listOrder(NewsModel $newsModel)
    {
        parent::listOrders($newsModel);
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
    public function toggle(NewsModel $newsModel)
    {
        $data = $this->request->param();

        if (isset($data['ids']) && !empty($data["display"])) {
            $ids = $this->request->param('ids/a');
            $newsModel->where('id', 'in', $ids)->update(['status' => 1]);
            $this->success("更新成功！");
        }

        if (isset($data['ids']) && !empty($data["hide"])) {
            $ids = $this->request->param('ids/a');
            $newsModel->where('id', 'in', $ids)->update(['status' => 0]);
            $this->success("更新成功！");
        }


    }

    /**
     * @param NewsModel $newsModel
     * 批量删除
     */

    public function deleteAll(NewsModel $newsModel)
    {
        parent::deleteAlls($newsModel);
        $this->success('删除成功！');
    }

    /**推荐&&取消推荐
     * @param ProductModel $productModel
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function recom(NewsModel $newsModel)
    {
        $data = $this->request->param();
        $newsModel->where('id', $data['id'])->update(['is_recom' => 1]);
        $this->success('推荐成功！');
    }

    public function cancelRecom(NewsModel $newsModel)
    {
        $data = $this->request->param();
        $newsModel->where('id', $data['id'])->update(['is_recom' => 0]);
        $this->success('取消推荐成功！');
    }

}