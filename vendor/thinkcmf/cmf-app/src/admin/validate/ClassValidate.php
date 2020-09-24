<?php


namespace app\admin\validate;


use think\Validate;

class ClassValidate extends Validate
{
    protected $rule = [
        'name' => 'require',
//        'pacon'  => 'require',
//        'painfo' => 'require',
//        'photo' => 'require',
//        'cid' => 'require',
    ];
    protected $message = [
        'name.require' => '分类名称不能为空',
//        'cid.unique'  => '内容分类不能为空',
    ];

    protected $scene = [
        'add'  => ['name'],
        'edit' => ['name'],
    ];
}