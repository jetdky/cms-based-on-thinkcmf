<?php


namespace app\admin\controller;


use app\admin\model\NewsModel;
use app\admin\model\ProductModel;
use app\admin\service\FunctionService;
use app\admin\service\ImgService;
use app\admin\service\SeoService;
use app\admin\service\TagService;
use app\admin\validate\NewsValidate;
use app\admin\validate\ProductValidate;
use cmf\controller\AdminBaseController;
use think\Db;
use tree\Tree;

class ProductController extends AdminBaseController
{

    public $type = 7;

    public function initialize()
    {
        parent::initialize();
        $this->assign("type", $this->type);
    }

    public function index(ProductModel $productModel)
    {
        $tree = new Tree();
        $parentId = $this->request->param("parent_id", 0, 'intval');
        $result = Db::name('class')->where(["type" => 3])->order(["order_num" => "ASC"])->select();
        $array = [];
        foreach ($result as $r) {
            $r['selected'] = $r['id'] == $parentId ? 'selected' : '';
            $array[] = $r;
        }
        $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);
        $selectClass = $tree->getTree(0, $str);

        $data = $this->request->param();
        $where = [];
        if (!empty($data['keyword'])) {
            $where[] = ['name', 'like', '%' . $data['keyword'] . '%'];
            $this->assign('keyword', $data['keyword']);
        }
        if (!empty($data['cid'])) {
            $where[] = ['cid', '=', $data['cid']];
            //todo: 根据父类id获得所有子类id，当前只查询一级父类
        }
        if (!empty($data['status'])) {
            $where[] = ['status', '=', $data['status']];
            $this->assign('status', $data['status']);
        }
        if (!empty($data['is_recom'])) {
            $where[] = ['is_recom', '=', $data['is_recom']];
            $this->assign('is_recom', $data['is_recom']);
        }
//        halt($where);
//        $list = $productModel->where($where)
//            ->with(['productImg.imgs'])
//            ->with(['productClass'])
//            ->with(['productImg' => function ($query) {
//                $query->where('type', '=', 7);
//            }])
//            ->order("order_num ASC")->paginate(10);

        $list = $productModel->where($where)
            ->with(['productImg', 'productImg.imgs', 'productClass'])
            ->order("order_num ASC")->paginate(10);
//        halt($productModel->getLastSql());
        // 获取分页显示
//        halt($list);
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
        $order_num = $FunctionService->get_order_num('product');
        $result = Db::name('class')->where(["type" => 3])->order(["order_num" => "ASC"])->select();
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


    public function addPost(ProductModel $productModel, ProductValidate $productValidate, ImgService $imgService, TagService $tagService, SeoService $seoService)
    {
        $data = $this->request->param();
        $result = $this->validate($data, 'Product.add');
        if ($result !== true) {
            $this->error($result);
        }
        Db::transaction(function () use ($productModel, $imgService, $tagService, $seoService, $data) {
            $productModel->allowField(true)->save($data);
            if (isset($data['img_list'])) {
                $imgService->doSave($data['img_list'], $data['type'], $productModel->id);
            }
            if ($data['tag_id']) {
                $tagService->doSave($data['tag_id'], $data['type'], $productModel->id);
            }
            if (!$data['is_auto_seo']) {
                $seoService->dosave($data, $data['type'], $productModel->id);
            }
        });
        $this->success("添加成功！", url("Product/index", ['type' => $this->type]));
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
        $product = DB::name('product')->where("id", $id)->find();
        $this->assign("product", $product);
        $productClass = DB::name('class')->where(['id' => $product['cid']])->find();

        $tree = new Tree();
        if ($productClass['parent_id'] == 0) {
            $parentId = $productClass['id'];
        } else {
            $parentId = $productClass['parent_id'];
        }
        $imgService = new ImgService();
        $seoService = new SeoService();
        $product['imgs'] = $imgService->read($id, $this->type);
        $product['seo'] = $seoService->read($id, $this->type);
        $result = Db::name('class')->where(["type" => 3])->order(["order_num" => "ASC"])->select();
        $array = [];
        foreach ($result as $r) {
            $r['selected'] = $r['id'] == $parentId ? 'selected' : '';
            $array[] = $r;
        }
        $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);
        $selectClass = $tree->getTree(0, $str);
        $this->assign("selectClass", $selectClass);
        $this->assign("product", $product);
//        halt($product);
        return $this->fetch();
    }


    public function editPost(ProductModel $productModel, ImgService $imgService, TagService $tagService, SeoService $seoService)
    {
        if ($this->request->isPost()) {
            $data = $this->request->param();
            $result = true;
            if ($result !== true) {
                // 验证失败 输出错误信息
                $this->error($result);
            } else {
                Db::transaction(function () use ($productModel, $imgService, $tagService, $seoService, $data) {
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
                    $result = $productModel->allowField(true)->update($data);
                });

                if ($result !== false) {
                    $this->success("保存成功！", url("product/index", ['type' => $data['type']]));
                } else {
                    $this->error("保存失败！");
                }
            }
        }
    }


    public function delete()
    {
        $id = $this->request->param('id', 0, 'intval');
        if (Db::name('product')->delete($id) !== false) {
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
            $result = Db::name('product')->where(["id" => $id])->setField('status', '0');
            if ($result !== false) {
                $this->success("内容停用成功！", url("Product/index"));
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
            $result = Db::name('product')->where(["id" => $id])->setField('status', '1');
            if ($result !== false) {
                $this->success("内容显示成功！", url("Product/index"));
            } else {
                $this->error('内容显示失败！');
            }
        } else {
            $this->error('数据传入失败！');
        }
    }


    public function listOrder(ProductModel $productModel)
    {
        parent::listOrders($productModel);
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
    public function toggle(ProductModel $productModel)
    {
        $data = $this->request->param();

        if (isset($data['ids']) && !empty($data["display"])) {
            $ids = $this->request->param('ids/a');
            $productModel->where('id', 'in', $ids)->update(['status' => 1]);
            $this->success("更新成功！");
        }

        if (isset($data['ids']) && !empty($data["hide"])) {
            $ids = $this->request->param('ids/a');
            $productModel->where('id', 'in', $ids)->update(['status' => 0]);
            $this->success("更新成功！");
        }


    }

}