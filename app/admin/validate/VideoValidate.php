<?php


namespace app\admin\validate;


use think\Validate;

class VideoValidate extends Validate
{
    protected $rule = [
        'name' => 'require',
        'content'  => 'require',
        'path'  => 'require',
        'lang'  => 'require',
        'status'  => 'require',
    ];

    protected $message = [
        'name.require' => '名称不能为空',
        'content.require'  => '视频介绍不能为空',
        'path.require'  => '视频不能为空',
        'lang.require'  => '请选择语言',
        'status.require'  => '请选择状态',
    ];

}