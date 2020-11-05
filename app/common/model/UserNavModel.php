<?php
/**
 * Time: 2020.09.14
 */

namespace app\common\model;


use think\Model;

class UserNavModel extends Model
{
    public function getUrlAttr($value)
    {
        if ($value) {
            if (!strpos($value, 'html')) {
                return url($value);
            }
            return $value;
        } else {
            return $value;
        }
    }
}