<?php


namespace app\admin\validate;


use think\Validate;

class VideoValidate extends Validate
{
    protected $rule = [
        'name' => 'require',
        'lang'  => 'require',
    ];

    protected $message = [
        'name.require' => '名称不能为空',
        'lang.require'  => '请选择语言',
    ];

}