<?php
/**
 *created by dengkunyao
 */

namespace app\index\service;


use app\common\model\UserNavModel;

class NavService
{
    public function getTreeNav()
    {
        $navModel = new UserNavModel();
        $navData = $navModel->select()->order('order_num')->toArray();
        return list_to_tree($navData, 'id', 'parent_id');
    }
}