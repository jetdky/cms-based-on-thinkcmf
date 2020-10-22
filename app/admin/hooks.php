<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2019 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 老猫 <thinkcmf@126.com>
// +----------------------------------------------------------------------
return [
    'admin_index_index_view'         => [
        "type"        => 2,//钩子类型(默认为应用钩子;2:应用钩子;3:模板钩子;4:后台模板钩子)
        "name"        => '后台首页界面', // 钩子名称
        "description" => "后台首页界面", //钩子描述
        "once"        => 1 // 是否只执行一次
    ],
    'admin_theme_design_view'        => [
        "type"        => 2,//钩子类型(默认为应用钩子;2:应用钩子;3:模板钩子;4:后台模板钩子)
        "name"        => '后台模板设计界面', // 钩子名称
        "description" => "后台模板设计界面", //钩子描述
        "once"        => 1 // 是否只执行一次
    ],
    'admin_setting_site_view'        => [
        "type"        => 2,//钩子类型(默认为应用钩子;2:应用钩子;3:模板钩子;4:后台模板钩子)
        "name"        => '后台设置网站信息界面', // 钩子名称
        "description" => "后台设置网站信息界面", //钩子描述
        "once"        => 1 // 是否只执行一次
    ],
    'admin_setting_clear_cache_view' => [
        "type"        => 2,//钩子类型(默认为应用钩子;2:应用钩子;3:模板钩子;4:后台模板钩子)
        "name"        => '后台清除缓存界面', // 钩子名称
        "description" => "后台清除缓存界面", //钩子描述
        "once"        => 1 // 是否只执行一次
    ],
    'admin_nav_index_view'           => [
        "type"        => 2,//钩子类型(默认为应用钩子;2:应用钩子;3:模板钩子;4:后台模板钩子)
        "name"        => '后台导航管理界面', // 钩子名称
        "description" => "后台导航管理界面", //钩子描述
        "once"        => 1 // 是否只执行一次
    ],
    'admin_link_index_view'          => [
        "type"        => 2,//钩子类型(默认为应用钩子;2:应用钩子;3:模板钩子;4:后台模板钩子)
        "name"        => '后台友情链接管理界面', // 钩子名称
        "description" => "后台友情链接管理界面", //钩子描述
        "once"        => 1 // 是否只执行一次
    ],
    'admin_slide_index_view'         => [
        "type"        => 2,//钩子类型(默认为应用钩子;2:应用钩子;3:模板钩子;4:后台模板钩子)
        "name"        => '后台标签库管理界面', // 钩子名称
        "description" => "后台标签库管理界面", //钩子描述
        "once"        => 1 // 是否只执行一次
    ],
    'admin_slide_item_index_view'         => [
        "type"        => 2,//钩子类型(默认为应用钩子;2:应用钩子;3:模板钩子;4:后台模板钩子)
        "name"        => '后台标签库页面列表界面', // 钩子名称
        "description" => "后台标签库页面列表界面", //钩子描述
        "once"        => 1 // 是否只执行一次
    ],
    'admin_slide_item_add_view'         => [
        "type"        => 2,//钩子类型(默认为应用钩子;2:应用钩子;3:模板钩子;4:后台模板钩子)
        "name"        => '后台标签库页面添加界面', // 钩子名称
        "description" => "后台标签库页面添加界面", //钩子描述
        "once"        => 1 // 是否只执行一次
    ],
    'admin_slide_item_edit_view'         => [
        "type"        => 2,//钩子类型(默认为应用钩子;2:应用钩子;3:模板钩子;4:后台模板钩子)
        "name"        => '后台标签库页面编辑界面', // 钩子名称
        "description" => "后台标签库页面编辑界面", //钩子描述
        "once"        => 1 // 是否只执行一次
    ],
    'admin_user_index_view'          => [
        "type"        => 2,//钩子类型(默认为应用钩子;2:应用钩子;3:模板钩子;4:后台模板钩子)
        "name"        => '后台管理员列表界面', // 钩子名称
        "description" => "后台管理员列表界面", //钩子描述
        "once"        => 1 // 是否只执行一次
    ],
    'admin_user_add_view'          => [
        "type"        => 2,//钩子类型(默认为应用钩子;2:应用钩子;3:模板钩子;4:后台模板钩子)
        "name"        => '后台管理员添加界面', // 钩子名称
        "description" => "后台管理员添加界面", //钩子描述
        "once"        => 1 // 是否只执行一次
    ],
    'admin_user_edit_view'          => [
        "type"        => 2,//钩子类型(默认为应用钩子;2:应用钩子;3:模板钩子;4:后台模板钩子)
        "name"        => '后台管理员编辑界面', // 钩子名称
        "description" => "后台管理员编辑界面", //钩子描述
        "once"        => 1 // 是否只执行一次
    ],
    'admin_rbac_index_view'          => [
        "type"        => 2,//钩子类型(默认为应用钩子;2:应用钩子;3:模板钩子;4:后台模板钩子)
        "name"        => '后台角色管理界面', // 钩子名称
        "description" => "后台角色管理界面", //钩子描述
        "once"        => 1 // 是否只执行一次
    ],
    'admin_rbac_role_add_view'          => [
        "type"        => 2,//钩子类型(默认为应用钩子;2:应用钩子;3:模板钩子;4:后台模板钩子)
        "name"        => '后台角色添加界面', // 钩子名称
        "description" => "后台角色添加界面", //钩子描述
        "once"        => 1 // 是否只执行一次
    ],
    'admin_rbac_role_edit_view'          => [
        "type"        => 2,//钩子类型(默认为应用钩子;2:应用钩子;3:模板钩子;4:后台模板钩子)
        "name"        => '后台角色编辑界面', // 钩子名称
        "description" => "后台角色编辑界面", //钩子描述
        "once"        => 1 // 是否只执行一次
    ],
    'admin_rbac_authorize_view'          => [
        "type"        => 2,//钩子类型(默认为应用钩子;2:应用钩子;3:模板钩子;4:后台模板钩子)
        "name"        => '后台角色授权界面', // 钩子名称
        "description" => "后台角色授权界面", //钩子描述
        "once"        => 1 // 是否只执行一次
    ],
    'admin_recycle_bin_index_view'   => [
        "type"        => 2,//钩子类型(默认为应用钩子;2:应用钩子;3:模板钩子;4:后台模板钩子)
        "name"        => '后台回收站界面', // 钩子名称
        "description" => "后台回收站界面", //钩子描述
        "once"        => 1 // 是否只执行一次
    ],
    'admin_menu_index_view'          => [
        "type"        => 2,//钩子类型(默认为应用钩子;2:应用钩子;3:模板钩子;4:后台模板钩子)
        "name"        => '后台菜单管理界面', // 钩子名称
        "description" => "后台菜单管理界面", //钩子描述
        "once"        => 1 // 是否只执行一次
    ],
    'admin_custom_login_open'        => [
        "type"        => 2,//钩子类型(默认为应用钩子;2:应用钩子;3:模板钩子;4:后台模板钩子)
        "name"        => '后台自定义登录是否开启钩子', // 钩子名称
        "description" => "后台自定义登录是否开启钩子", //钩子描述
        "once"        => 1 // 是否只执行一次
    ],
    'admin_pacontent_default_view'        => [
        "type"        => 2,//钩子类型(默认为应用钩子;2:应用钩子;3:模板钩子;4:后台模板钩子)
        "name"        => '后台内容管理界面', // 钩子名称
        "description" => "后台内容管理界面", //钩子描述
        "once"        => 1 // 是否只执行一次
    ],

];