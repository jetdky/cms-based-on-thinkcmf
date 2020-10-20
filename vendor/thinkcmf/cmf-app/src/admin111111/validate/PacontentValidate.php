<?php


namespace app\admin\validate;


use think\Validate;

class PacontentValidate extends Validate
{
    protected $rule = [
//        'paname' => 'require',
//        'pacon'  => 'require',
//        'painfo' => 'require',
//        'photo' => 'require',
        'cid' => 'require',
    ];
    protected $message = [
//        'paname.require' => '内容的名称不能为空',
        'cid.unique'  => '内容分类不能为空',
    ];

    protected $scene = [
        'add'  => ['paname', 'cid'],
        'edit' => ['paname', 'cid'],
    ];
}