<?php


namespace app\admin\controller;


use cmf\controller\AdminBaseController;

class MoveController extends AdminBaseController
{
    public function index()
    {
        $ids = $this->request->param('ids/a');
//        $ids = implode(',',$ids);
        $this->assign('id',$ids);
        return $this->fetch();
    }
}