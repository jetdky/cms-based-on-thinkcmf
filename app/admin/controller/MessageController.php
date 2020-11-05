<?php


namespace app\admin\controller;


use app\common\model\LinkModel;
use app\common\model\MessageModel;
use app\common\model\VideoModel;
use cmf\controller\AdminBaseController;

class MessageController extends AdminBaseController
{
//    protected $targets = ["_blank" => "新标签页打开", "_self" => "本窗口打开"];

    /**
     * 留言板管理
     * @adminMenu(
     *     'name'   => '留言板',
     *     'parent' => 'admin/Setting/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 50,
     *     'icon'   => '',
     *     'remark' => '留言板管理',
     *     'param'  => ''
     * )
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index(MessageModel $messageModel)
    {
//        $content = hook_one('admin_link_index_view');

//        if (!empty($content)) {
//            return $content;
//        }

        $linkModel = new LinkModel();
        $messages = $messageModel->select();
        $this->assign('messages', $messages);

        return $this->fetch();
    }

    /**
     * 添加留言板
     * @adminMenu(
     *     'name'   => '添加留言板',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加留言板',
     *     'param'  => ''
     * )
     */
    public function add()
    {
        $this->assign('targets', $this->targets);//参数疑问
        return $this->fetch();
    }

    /**
     * 添加留言板提交保存
     * @adminMenu(
     *     'name'   => '添加留言板提交保存',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加留言板提交保存',
     *     'param'  => ''
     * )
     */
    public function addPost(MessageModel $messageModel)
    {
        $data = $this->request->param();
//        $linkModel = new LinkModel();
        $result = $this->validate($data, 'Message');
        if ($result !== true) {
            $this->error($result);
        }
        $messageModel->allowField(true)->save($data);

        $this->success("添加成功！", url("Message/index"));
    }

    /**
     * 编辑留言板
     * @adminMenu(
     *     'name'   => '编辑留言板',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑留言板',
     *     'param'  => ''
     * )
     * @return mixed
     * @throws \think\Exception\DbException
     */
    public function edit()
    {
        $data = $this->request->param();
        model('message')->where('id', $data['id'])->update(['status' => 1]);
        $message = model('message')->find($data['id']);
        $this->assign('data', $message);
        return $this->fetch();
    }

    /**
     * 编辑留言板提交保存
     * @adminMenu(
     *     'name'   => '编辑留言板提交保存',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑留言板提交保存',
     *     'param'  => ''
     * )
     */
    public function editPost()
    {
        $data = $this->request->param();
        $linkModel = new LinkModel();
        $result = $this->validate($data, 'Link');
        if ($result !== true) {
            $this->error($result);
        }
        $linkModel->allowField(true)->isUpdate(true)->save($data);

        $this->success("保存成功！", url("Link/index"));
    }

    /**
     * 删除留言板
     * @adminMenu(
     *     'name'   => '删除留言板',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '删除留言板',
     *     'param'  => ''
     * )
     */
    public function delete()
    {
        $id = $this->request->param('id', 0, 'intval');
        MessageModel::destroy($id);
        $this->success("删除成功！", url("message/index"));
    }

    /**
     * 留言板排序
     * @adminMenu(
     *     'name'   => '留言板排序',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '留言板排序',
     *     'param'  => ''
     * )
     */
    public function listOrder(MessageModel $messageModel)
    {
//        $linkModel = new  LinkModel();
        parent::listOrders($messageModel);
        $this->success("排序更新成功！");
    }

    /**
     * 留言板显示隐藏
     * @adminMenu(
     *     'name'   => '留言板显示隐藏',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '留言板显示隐藏',
     *     'param'  => ''
     * )
     */
    public function toggle(MessageModel $messageModel)
    {
        $data = $this->request->param();

        if (isset($data['ids']) && !empty($data["display"])) {
            $ids = $this->request->param('ids/a');
            $messageModel->where('id', 'in', $ids)->update(['status' => 1]);
            $this->success("更新成功！");
        }

        if (isset($data['ids']) && !empty($data["hide"])) {
            $ids = $this->request->param('ids/a');
            $messageModel->where('id', 'in', $ids)->update(['status' => 0]);
            $this->success("更新成功！");
        }


    }

    /**
     * @param VideoModel $videoModel
     * 批量删除
     */

    public function deleteAll(MessageModel $messageModel){
        parent::deleteAlls($messageModel);
        $this->success('删除成功！');
    }


}