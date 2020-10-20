<?php


namespace app\admin\controller;


use app\admin\model\ClassModel;
use app\admin\model\ImgContentModel;
use app\admin\model\ImgModel;
use app\admin\model\NewsModel;
use app\admin\model\PacontentModel;
use app\admin\model\TagContentModel;
use app\admin\model\TagModel;
use app\admin\model\VideoModel;
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
    public $categoryType = 2;

    public function initialize()
    {
        parent::initialize();
        $this->assign("type", $this->type);
    }

    public function index(NewsModel $newsModel)
    {
        $tree = new Tree();
        $result = Db::name('class')->where(["type" => $this->categoryType])->order(["order_num" => "ASC"])->select();
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
        $result = Db::name('class')->where(["type" => $this->categoryType])->order(["order_num" => "ASC"])->select();
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
    public function edit(NewsModel $newsModel)
    {

        $id = $this->request->param('id', 0, 'intval');
        $this->assign('id', $id);
        $news = $newsModel->where("id", $id)->find();
        $newsClass = DB::name('class')->where(['id' => $news['cid']])->find();

        $tree = new Tree();
        if ($newsClass['parent_id'] == 0) {
            $parentId = $newsClass['id'];
        } else {
            $parentId = $newsClass['parent_id'];
        }
        $imgService = new ImgService();
        $seoService = new SeoService();
        $news['imgs'] = $imgService->read($id, $this->type);
        $news['seo'] = $seoService->read($id, $this->type);
        $result = Db::name('class')->where(["type" => $this->categoryType])->order(["order_num" => "ASC"])->select();
        $array = [];
        foreach ($result as $r) {
            $r['selected'] = $r['id'] == $parentId ? 'selected' : '';
            $array[] = $r;
        }
        $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);
        $selectClass = $tree->getTree(0, $str);
        $this->assign("selectClass", $selectClass);
        $this->assign("news", $news);
        return $this->fetch();
    }


    public function editPost(NewsModel $newsModel, ImgService $imgService, TagService $tagService, SeoService $seoService)
    {
        if ($this->request->isPost()) {
            $data = $this->request->param();
            $result = true;
            if ($result !== true) {
                // 验证失败 输出错误信息
                $this->error($result);
            } else {
                Db::transaction(function () use ($newsModel, $imgService, $tagService, $seoService, $data) {
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
                    $result = $newsModel->allowField(true)->update($data);
                });

                if ($result !== false) {
                    $this->success("保存成功！", url("News/index", ['type' => $data['type']]));
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

    /**
     * ajax 获取class列表用于批量移动和复制
     * @param
     */
    public function getClassList(ClassModel $classModel)
    {
        $list = $classModel->where(['type' => 2])->order("order_num ASC")->select()->toArray();
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
        Db::name('news')->whereIn('id', $id_array)->update(['cid' => $data['cid'], 'lang' => $data['lang']]);
        return true;

    }

    /**
     * ajax 批量复制
     * @param
     */
    public function saveCopy(NewsModel $newsModel, ImgContentModel $imgContentModel,TagContentModel $tagContentModel)
    {
        $data = $this->request->param();
        $id_array = explode(',', $data['id']);
        $newsData = $newsModel->whereIn('id', $id_array)
            ->with(['newsImg', 'newsImg.imgs', 'newsClass'])
            ->order("order_num ASC")->select()->toArray();
        foreach ($newsData as $k => $v) {
            $imgs = $imgContentModel->where(['content_id'=>$v['id'],'type'=>$this->type])->select()->toArray();
            $tags = $tagContentModel->where(['content_id'=>$v['id'],'type'=>$this->type])->select()->toArray();
            unset($v['id']);
            $v['cid'] = $data['cid'];
            $v['lang'] = $data['lang'];
            $newsModel->isUpdate(false)->data($v,true)->save($v);
            $id = $newsModel->id;
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