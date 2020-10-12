<?php


namespace app\admin\controller;


use app\admin\model\NewsModel;
use app\admin\validate\NewsValidate;
use cmf\controller\AdminBaseController;
use think\Db;
use think\db\Query;
use tree\Tree;

class NewsController extends AdminBaseController
{

    public function index(NewsModel $newsModel)
    {
//        $content = hook_one('admin_pacontent_default_view');
//
//        if (!empty($content)) {
//            return $content;
//        }
        $data = $this->request->param();
        $where = [];
        if(!empty($data['keyword'])){
            $where[] = array('title','like','%'.$data['keyword'].'%');
            $this->assign('keyword', $data['keyword']);
        }
        $list = NewsModel::where($where)
            ->with(['newsClass'])
            ->order("list_order ASC")
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
    public function add()
    {
        $tree     = new Tree();
        $parentId = $this->request->param("parent_id", 0, 'intval');
        $data = $this->request->param();
        $result   = Db::name('class')->where(["type"=>2])->order(["list_order" => "ASC"])->select();
        $array    = [];
        foreach ($result as $r) {
            $r['selected'] = $r['id'] == $parentId ? 'selected' : '';
            $array[]       = $r;
        }
        $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);
        $selectClass = $tree->getTree(0, $str);
        $this->assign("selectClass", $selectClass);
        return $this->fetch();
    }


    public function addPost(NewsModel $newsModel,NewsValidate $newsValidate)
    {
        $data = $this->request->param();
        $isFindNews = $newsModel->where(['title'=>$data['title'],'lang'=>$data['lang']])->find();
        if($isFindNews){
            if($data['lang'] == 0){
                $lang = "英文";
            }else{
                $lang = "中文";
            }
            $this->error("此标题在".$lang."已存在");
        }
//        $linkModel = new P();
//        $pacontentValidate->with('add')->check($data);
        $result    = $this->validate($data, 'news.add');

        if ($result !== true) {
            $this->error($result);
        }
        $newsModel->allowField(true)->save($data);

        $this->success("添加成功！", url("news/index"));
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
        $this->assign('id',$id);

        $news = DB::name('news')->where("id", $id)->find();


        $this->assign("news",$news);
        $paclass = DB::name('class')->where(['id'=>$news['cid']])->find();

        $tree     = new Tree();
        if($paclass['parent_id'] == 0){
            $parentId = $paclass['id'];
        }else{
            $parentId = $paclass['parent_id'];
        }

        $result   = Db::name('class')->where(["type"=>2])->order(["list_order" => "ASC"])->select();
        $array    = [];
        foreach ($result as $r) {
            $r['selected'] = $r['id'] == $parentId ? 'selected' : '';
            $array[]       = $r;
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

            $isFindNews = DB::name('news')->where(['title'=>$data['title'],'lang'=>$data['lang']])->all();

            foreach($isFindNews as $findNew){
                if($findNew['id'] != $data['id']){
                    if($data['lang'] == 0){
                        $lang = "英文";
                    }else{
                        $lang = "中文";
                    }
                    $this->error("此标题在".$lang."已存在");
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
        $data      = $this->request->param();

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


}