<?php


namespace app\admin\controller;


use app\common\model\ClassModel;
use app\common\model\ImgContentModel;
use app\common\model\ProductModel;
use app\common\model\VideoModel;
use app\admin\service\ClassService;
use app\admin\service\ImgService;
use app\admin\validate\ProductValidate;
use app\admin\validate\VideoValidate;
use cmf\controller\AdminBaseController;
use think\Db;
use tree\Tree;

class VideoController extends AdminBaseController
{
    public $type = 9; //图片标识
    public $categoryType = 4;  //分类标识

    public function initialize()
    {
        parent::initialize();
        $this->assign("type", $this->type);
    }

    public function index(VideoModel $videoModel)
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
        if (isset($data['keyword']) && $data['keyword'] !== "") {
            $where[] = ['name', 'like', '%' . $data['keyword'] . '%'];
            $this->assign('keyword', $data['keyword']);
        }
        if (isset($data['cid']) && $data['cid'] !== "") {
            $sonCategory = build_category_tree($result, $data['cid']);
            $sonCategoryId = [];
            foreach ($sonCategory as $value){
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
        if(isset($data['lang']) && $data['lang'] !== ""){
            $where[] = ['lang', '=', $data['lang']];
            $this->assign('lang', $data['lang']);
        }
        $list = $videoModel->where($where)
            ->with(['videoImg', 'videoImg.imgs', 'videoClass'])
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
    public function add(Tree $tree, VideoModel $videoModel)
    {
        $tree = new Tree();
        $data = $this->request->param();
        $parentId = @$data['cid'] ?: 0;
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
        $orderby1 = $videoModel->order(["order_num" => "DESC"])->find();
        if ($orderby1) {
            $orderbydata = $orderby1['order_num'] + 1;
        } else {
            $orderbydata = 1;
        }
        $this->assign("orderbydata", $orderbydata);
        $this->assign("lang", @$data['lang'] ?: 1);

        return $this->fetch();
    }


    public function addPost(VideoModel $videoModel, VideoValidate $videoValidate,ImgService $imgService)
    {
        $data = $this->request->param();
        $isFindVideo = $videoModel->where(['name' => $data['name'], 'lang' => $data['lang']])->find();
        if ($isFindVideo) {
            if ($data['lang'] == 0) {
                $lang = "英文";
            } else {
                $lang = "中文";
            }
            $this->error("此视频在" . $lang . "已存在");
        }
        $result = $this->validate($data, 'Video.add');

        if ($result !== true) {
            $this->error($result);
        }
        Db::transaction(function () use ($videoModel, $imgService,  $data) {
            $videoModel->allowField(true)->save($data);
            if (isset($data['img_list'])) {
                $imgService->doSave($data['img_list'], $data['type'], $videoModel->id);
            }
        });

        $this->success("添加成功！", url("Video/add", ['type' => $this->type, 'cid' => $data['cid'], 'lang' => $data['lang']]));
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
    public function edit(ImgService $imgService,VideoModel $videoModel)
    {

        $id = $this->request->param('id', 0, 'intval');
        $this->assign('id', $id);

        $video = DB::name('video')->where("id", $id)->find();


        $this->assign("video", $video);
        $videoClass = DB::name('class')->where(['id' => $video['cid']])->find();
        $tree = new Tree();
        $parentId = $videoClass['id'];
        $video['imgs'] = $imgService->read($id, $this->type);

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
        $this->assign("video", $video);
        return $this->fetch();
    }


    public function editPost(VideoModel $videoModel)
    {
        if ($this->request->isPost()) {

            $data = $this->request->param();

            $isFindVideo = DB::name('video')->where(['name' => $data['name'], 'lang' => $data['lang']])->all();
            foreach ($isFindVideo as $FindVideo) {

                if ($FindVideo['id'] != $data['id']) {
                    if ($data['lang'] == 0) {
                        $lang = "英文";
                    } else {
                        $lang = "中文";
                    }
                    $this->error("此视频在" . $lang . "已存在");
                }
            }
            $result = $this->validate($this->request->param(), 'Video.edit');
            if ($result !== true) {
                // 验证失败 输出错误信息
                $this->error($result);
            } else {
                $result = DB::name('video')->update($_POST);
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
        if (Db::name('video')->delete($id) !== false) {
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


    public function listOrder(VideoModel $videoModel)
    {
        parent::listOrders($videoModel);
        $this->success("排序更新成功！");
    }

    /**
     * @param VideoModel $videoModel
     * 批量删除
     */

    public function deleteAll(VideoModel $videoModel)
    {
        parent::deleteAlls($videoModel);
        $this->success('删除成功！');
    }

    /**
     * @param VideoModel $videoModel
     * 批量删除
     */

    public function remove(VideoModel $videoModel)
    {
        parent::moveAlls($videoModel);
        $this->success('移动成功！');
    }

    /**
     * @param VideoModel $videoModel
     */

    public function copy(VideoModel $videoModel)
    {
        parent::copyAlls($videoModel);
        $this->success('复制成功！');
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
    public function toggle(VideoModel $videoModel)
    {
        $data = $this->request->param();

        if (isset($data['ids']) && !empty($data["display"])) {
            $ids = $this->request->param('ids/a');
            $videoModel->where('id', 'in', $ids)->update(['status' => 1]);
            $this->success("更新成功！");
        }

        if (isset($data['ids']) && !empty($data["hide"])) {
            $ids = $this->request->param('ids/a');
            $videoModel->where('id', 'in', $ids)->update(['status' => 0]);
            $this->success("更新成功！");
        }
    }

    /**
     * ajax 获取class列表用于批量移动和复制
     * @param
     */
    public function getClassList(ClassModel $classModel)
    {
        $list = $classModel->where(['type' => $this->categoryType])->order("order_num ASC")->select()->toArray();
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
        Db::name('video')->whereIn('id', $id_array)->update(['cid' => $data['cid'], 'lang' => $data['lang']]);
        return true;

    }

    /**
     * ajax 批量复制
     * @param
     */
    public function saveCopy(VideoModel $videoModel)
    {
        $data = $this->request->param();
        $id_array = explode(',', $data['id']);
        $result = Db::name('video')->whereIn('id', $id_array)->select();
        $inData = [];
        foreach ($result as $k => $v) {
            unset($v['id']);
            $v['cid'] = $data['cid'];
            $v['lang'] = $data['lang'];
            $inData[] = $v;
        }
        $videoModel->saveAll($inData);
        return true;
    }

}