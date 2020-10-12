<?php


function getTime($time)
{
    return date('Y-m-d H:i:s', $time);
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

/** 转换成树形结构
 * @param $array
 * @return mixed
 */
function build_category_tree($array){
        foreach ($array as $key1 => $value1) {
            foreach ($array as $key2 => $value2 ){
                if($value2['id'] == $value1['parent_id']){
                    $array[$key2]['children'][] = $array[$key1];
                    unset($array[$key1]);
                }
            }
        }
        return $array;
}

function get_category_recursion($array, $level){
    

}