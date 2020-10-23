<?php


namespace app\admin\validate;

use think\Validate;
class RecruitValidate extends Validate
{
    protected $rule = [
        'name' => 'require',
//        'pacon'  => 'require',
//        'painfo' => 'require',
//        'photo' => 'require',
//        'cid' => 'require',
    ];
    protected $message = [
        'name.require' => '文章标题不能为空',
        'cid.unique'  => '文章分类不能为空',
    ];

    protected $scene = [
        'add'  => ['name'],
        'edit' => ['name'],
    ];
}