<?php


function getTime($time)
{
    return date('Y-m-d H:i:s', $time ?: 0);
}


function getLang($lang)
{
    if ($lang == 0) {
        return '英文';
    }
    return '中文';
}

//一维数组
function toLevel($cate, $delimiter = '———', $parent_id = 0, $level = 0)
{

    $arr = array();
    foreach ($cate as $v) {
        if ($v['pid'] == $parent_id) {
            $v['level'] = $level + 1;
//                $v['delimiter'] = str_repeat($delimiter, $level);
            $arr[] = $v;
            $arr = array_merge($arr, $this->toLevel($cate, $delimiter, $v['id'], $v['level']));
        }
    }
    return $arr;
}

/**
 * 去除html标签
 */

function removeHtml($data)
{
    return htmlspecialchars_decode($data);
}

/**
 * 递归实现无限极分类
 * @param $array 分类数据
 * @param $pid 父ID
 * @param $level 分类级别
 * @return $list 分好类的数组 直接遍历即可 $level可以用来遍历缩进
 */

function build_category_tree($array, $pid = 0, $level = 1, $is_first = 1)
{
    //声明静态数组,避免递归调用时,多次声明导致数组覆盖
    static $list = [];

    //解决多次调用值重复
    if ($is_first){
        $list = [];
    }
    foreach ($array as $key => $value) {
        //第一次遍历,找到父节点为根节点的节点 也就是pid=0的节点
        if ($value['parent_id'] == $pid) {
            //父节点为根节点的节点,级别为0，也就是第一级
            $value['level'] = $level;
            //把数组放到list中
            $list[] = $value;
            //把这个节点从数组中移除,减少后续递归消耗
//            unset($array[$key]);
            //开始递归,查找父ID为该节点ID的节点,级别则为原级别+1
            build_category_tree($array, $value['id'], $level + 1, 0);
        }
    }
    return $list;
}

/** 删除某文件夹下所有
 * @param $path
 */
function clear_dir($path = null)
{
    if (is_dir($path)) {    //判断是否是目录
        $p = scandir($path);     //获取目录下所有文件
        foreach ($p as $value) {
            if ($value != '.' && $value != '..') {    //排除掉当./和../
                if (is_dir($path . '/' . $value)) {
                    $this->clear_dir($path . '/' . $value);    //递归调用删除方法
                    rmdir($path . '/' . $value);    //删除当前文件夹
                } else {
                    unlink($path . '/' . $value);    //删除当前文件
                }
            }
        }
    }
}

/**
 *created by dengkunyao
 * @param $array
 * @param $id
 * 判断id是否在array有子类
 */
function is_have_son($array, $id)
{
    foreach ($array as $key => $value) {
        if ($value['parent_id'] == $id) {
            return true;
        }
    }
    return false;
}

function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0)
{
    // 创建Tree
    $tree = array();
    if (is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] =& $list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId = $data[$pid];
            if ($root == $parentId) {
                $tree[] =& $list[$key];
            } else {
                if (isset($refer[$parentId])) {
                    $parent =& $refer[$parentId];
                    $parent[$child][] =& $list[$key];
                }
            }
        }
    }
    return $tree;
}
