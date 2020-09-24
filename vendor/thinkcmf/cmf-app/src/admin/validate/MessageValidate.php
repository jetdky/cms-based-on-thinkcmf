<?php


namespace app\admin\validate;


use think\Validate;

class MessageValidate extends Validate
{
    protected $rule = [
        'name' => 'require',
        'phone'  => 'require',
        'address'  => 'require',
    ];

    protected $message = [
        'name.require' => '名称不能为空',
        'phone.require'  => '电话不能为空',
        'address.require'  => '地址不能为空',
    ];

}