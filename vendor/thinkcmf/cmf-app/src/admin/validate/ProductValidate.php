<?php


namespace app\admin\validate;


use think\Validate;

class ProductValidate extends Validate
{

    protected $rule = [
        'name' => 'require',
        'cid' => 'require',
    ];
    protected $message = [
        'name.require' => '产品名称不能为空',
        'cid.unique'  => '产品分类不能为空',
    ];

    protected $scene = [
        'add'  => ['name', 'cid'],
        'edit' => ['name', 'cid'],
    ];
}