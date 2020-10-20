<?php


namespace app\admin\service;


use app\admin\model\ClassModel;
use cmf\controller\AdminBaseController;
use think\Db;

class ClassService extends AdminBaseController
{

    /**
     * 视频分类弹框
     */
    public function classPopOutList($type)
    {
        $classModel = new ClassModel();
        $list = $classModel->where(['type' => $type])->order("order_num ASC")->select()->toArray();
        return json_encode($list);
    }

    /**
     * @return bool
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 移动
     */
    public function saveMove(){
        $data = $this->request->param();
        $id_array=explode(',',$data['id']);
        Db::name('video')->whereIn('id', $id_array)->update(['cid' =>$data['cid'],'lang'=>$data['lang']]);
        return true;

    }


    /**
     * @return bool
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 复制
     */
    public function saveCopy(){
        $data = $this->request->param();
        $id_array=explode(',',$data['id']);
        Db::name('video')->whereIn('id', $id_array)->update(['cid' =>$data['cid'],'lang'=>$data['lang']]);
        return true;

    }

}