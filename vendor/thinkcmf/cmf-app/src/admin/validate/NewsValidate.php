<?php


namespace app\admin\validate;


use think\Validate;

class NewsValidate extends Validate
{
    protected $rule = [
        'title' => 'require',
//        'pacon'  => 'require',
//        'painfo' => 'require',
//        'photo' => 'require',
        'cid' => 'require',
    ];
    protected $message = [
        'title.require' => '文章标题不能为空',
        'cid.unique'  => '文章分类不能为空',
    ];

    protected $scene = [
        'add'  => ['title', 'cid'],
        'edit' => ['title', 'cid'],
    ];
}