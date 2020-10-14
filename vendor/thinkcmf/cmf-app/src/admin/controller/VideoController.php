<?php


namespace app\admin\controller;


use app\admin\model\ClassModel;
use app\admin\model\ProductModel;
use app\admin\model\VideoModel;
use app\admin\service\ClassService;
use app\admin\validate\ProductValidate;
use app\admin\validate\VideoValidate;
use cmf\controller\AdminBaseController;
use think\Db;
use tree\Tree;

class VideoController extends AdminBaseController
{
    public function index(VideoModel $videoModel)
    {

        $data = $this->request->param();
        $where = [];
        if (!empty($data['keyword'])) {
            $where[] = array('name', 'like', '%' . $data['keyword'] . '%');
            $this->assign('keyword', $data['keyword']);
        }
        $list = $videoModel->where($where)
            ->with(['videoClass'])
            ->order("order_num ASC")
            ->paginate(10);
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
    public function add(Tree $tree, VideoModel $videoModel)
    {
        $tree = new Tree();
        $parentId = $this->request->param("parent_id", 0, 'intval');
        $data = $this->request->param();
        $result = Db::name('class')->where(["type" => 4])->order(["order_num" => "ASC"])->select();
        $array = [];
        foreach ($result as $r) {
            $r['selected'] = $r['id'] == $parentId ? 'selected' : '';
            $array[] = $r;
        }
        $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
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
        return $this->fetch();
    }


    public function addPost(VideoModel $videoModel, VideoValidate $videoValidate)
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
        $videoModel->allowField(true)->save($data);

        $this->success("添加成功！", url("Video/index"));
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
        /*
        $content = hook_one('admin_pacontent_edit_view');
        if (!empty($content)) {
            return $content;
        }
        */

        $id = $this->request->param('id', 0, 'intval');
        $this->assign('id', $id);

        $video = DB::name('video')->where("id", $id)->find();


        $this->assign("video", $video);
        $videoClass = DB::name('class')->where(['id' => $video['cid']])->find();

        $tree = new Tree();
        if ($videoClass['parent_id'] == 0) {
            $parentId = $videoClass['id'];
        } else {
            $parentId = $videoClass['parent_id'];
        }

        $result = Db::name('class')->where(["type" => 4])->order(["order_num" => "ASC"])->select();
        $array = [];
        foreach ($result as $r) {
            $r['selected'] = $r['id'] == $parentId ? 'selected' : '';
            $array[] = $r;
        }
        $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);
        $selectClass = $tree->getTree(0, $str);
        $this->assign("selectClass", $selectClass);
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
        $list = $classModel->where(['type' => 4])->order("order_num ASC")->select()->toArray();
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