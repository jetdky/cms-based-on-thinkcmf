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