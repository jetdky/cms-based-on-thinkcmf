<?php


namespace app\admin\service;

use think\Db;

class FunctionService
{

    /**
     * 获得排序数
     *
     * @param string $table 表名
     * @param string|int $type 需要寻找的表类型名或id，默认没有类型
     * @return int 排序数
     */
    public function get_order_num($table, $type = ''): int
    {
        $where = [];
        if ($type) {
            if (is_numeric($type)) {
                $where['type'] = $type;
            } else {
                $type_id = Db::name('type')->where('title', $type)->value('id');
                $where['type'] = $type_id;
            }
        }
        $tableCount = Db::name($table)->where($where)->count('id');
        if ($tableCount) {
            $max = (int)Db::name($table)->where($where)->max('order_num');
            return $orderNum = $max + 1;
        } else {
            return $orderNum = 1;
        }
    }

}