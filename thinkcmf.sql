/*
 Navicat Premium Data Transfer

 Source Server         : localWin
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : thinkcmf

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 05/11/2020 11:22:02
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cmf_admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `cmf_admin_menu`;
CREATE TABLE `cmf_admin_menu`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '父菜单id',
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '菜单类型;1:有界面可访问菜单,2:无界面可访问菜单,0:只作为菜单',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '状态;1:显示,0:不显示',
  `order_num` float NOT NULL DEFAULT 10000 COMMENT '排序',
  `app` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '应用名',
  `controller` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '控制器名',
  `action` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '操作名称',
  `param` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '额外参数',
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单名称',
  `icon` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '菜单图标',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `status`(`status`) USING BTREE,
  INDEX `parent_id`(`parent_id`) USING BTREE,
  INDEX `controller`(`controller`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 145 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '后台菜单表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_admin_menu
-- ----------------------------
INSERT INTO `cmf_admin_menu` VALUES (1, 0, 1, 0, 20, 'admin', 'Plugin', 'default', '', '插件中心', 'cloud', '插件中心');
INSERT INTO `cmf_admin_menu` VALUES (2, 1, 1, 1, 10000, 'admin', 'Hook', 'index', '', '钩子管理', '', '钩子管理');
INSERT INTO `cmf_admin_menu` VALUES (3, 2, 1, 0, 10000, 'admin', 'Hook', 'plugins', '', '钩子插件管理', '', '钩子插件管理');
INSERT INTO `cmf_admin_menu` VALUES (4, 2, 2, 0, 10000, 'admin', 'Hook', 'pluginListOrder', '', '钩子插件排序', '', '钩子插件排序');
INSERT INTO `cmf_admin_menu` VALUES (5, 2, 1, 0, 10000, 'admin', 'Hook', 'sync', '', '同步钩子', '', '同步钩子');
INSERT INTO `cmf_admin_menu` VALUES (6, 0, 0, 1, 0, 'admin', 'Setting', 'default', '', '设置', 'cogs', '系统设置入口');
INSERT INTO `cmf_admin_menu` VALUES (7, 6, 1, 0, 50, 'admin', 'Link', 'index', '', '友情链接', '', '友情链接管理');
INSERT INTO `cmf_admin_menu` VALUES (8, 7, 1, 0, 10000, 'admin', 'Link', 'add', '', '添加友情链接', '', '添加友情链接');
INSERT INTO `cmf_admin_menu` VALUES (9, 7, 2, 0, 10000, 'admin', 'Link', 'addPost', '', '添加友情链接提交保存', '', '添加友情链接提交保存');
INSERT INTO `cmf_admin_menu` VALUES (10, 7, 1, 0, 10000, 'admin', 'Link', 'edit', '', '编辑友情链接', '', '编辑友情链接');
INSERT INTO `cmf_admin_menu` VALUES (11, 7, 2, 0, 10000, 'admin', 'Link', 'editPost', '', '编辑友情链接提交保存', '', '编辑友情链接提交保存');
INSERT INTO `cmf_admin_menu` VALUES (12, 7, 2, 0, 10000, 'admin', 'Link', 'delete', '', '删除友情链接', '', '删除友情链接');
INSERT INTO `cmf_admin_menu` VALUES (13, 7, 2, 0, 10000, 'admin', 'Link', 'listOrder', '', '友情链接排序', '', '友情链接排序');
INSERT INTO `cmf_admin_menu` VALUES (14, 7, 2, 0, 10000, 'admin', 'Link', 'toggle', '', '友情链接显示隐藏', '', '友情链接显示隐藏');
INSERT INTO `cmf_admin_menu` VALUES (15, 6, 2, 0, 10, 'admin', 'Mailer', 'index', '', '邮箱配置', '', '邮箱配置');
INSERT INTO `cmf_admin_menu` VALUES (16, 15, 2, 0, 10000, 'admin', 'Mailer', 'indexPost', '', '邮箱配置提交保存', '', '邮箱配置提交保存');
INSERT INTO `cmf_admin_menu` VALUES (17, 15, 1, 0, 10000, 'admin', 'Mailer', 'template', '', '邮件模板', '', '邮件模板');
INSERT INTO `cmf_admin_menu` VALUES (18, 15, 2, 0, 10000, 'admin', 'Mailer', 'templatePost', '', '邮件模板提交', '', '邮件模板提交');
INSERT INTO `cmf_admin_menu` VALUES (19, 15, 1, 0, 10000, 'admin', 'Mailer', 'test', '', '邮件发送测试', '', '邮件发送测试');
INSERT INTO `cmf_admin_menu` VALUES (20, 6, 1, 0, 10000, 'admin', 'Menu', 'index', '', '后台菜单', '', '后台菜单管理');
INSERT INTO `cmf_admin_menu` VALUES (21, 20, 1, 0, 10000, 'admin', 'Menu', 'lists', '', '所有菜单', '', '后台所有菜单列表');
INSERT INTO `cmf_admin_menu` VALUES (22, 20, 1, 0, 10000, 'admin', 'Menu', 'add', '', '后台菜单添加', '', '后台菜单添加');
INSERT INTO `cmf_admin_menu` VALUES (23, 20, 2, 0, 10000, 'admin', 'Menu', 'addPost', '', '后台菜单添加提交保存', '', '后台菜单添加提交保存');
INSERT INTO `cmf_admin_menu` VALUES (24, 20, 1, 0, 10000, 'admin', 'Menu', 'edit', '', '后台菜单编辑', '', '后台菜单编辑');
INSERT INTO `cmf_admin_menu` VALUES (25, 20, 2, 0, 10000, 'admin', 'Menu', 'editPost', '', '后台菜单编辑提交保存', '', '后台菜单编辑提交保存');
INSERT INTO `cmf_admin_menu` VALUES (26, 20, 2, 0, 10000, 'admin', 'Menu', 'delete', '', '后台菜单删除', '', '后台菜单删除');
INSERT INTO `cmf_admin_menu` VALUES (27, 20, 2, 0, 10000, 'admin', 'Menu', 'listOrder', '', '后台菜单排序', '', '后台菜单排序');
INSERT INTO `cmf_admin_menu` VALUES (28, 20, 1, 0, 10000, 'admin', 'Menu', 'getActions', '', '导入新后台菜单', '', '导入新后台菜单');
INSERT INTO `cmf_admin_menu` VALUES (29, 6, 1, 1, 30, 'admin', 'Nav', 'index', '', '导航管理', '', '导航管理');
INSERT INTO `cmf_admin_menu` VALUES (30, 29, 1, 0, 10000, 'admin', 'Nav', 'add', '', '添加导航', '', '添加导航');
INSERT INTO `cmf_admin_menu` VALUES (31, 29, 2, 0, 10000, 'admin', 'Nav', 'addPost', '', '添加导航提交保存', '', '添加导航提交保存');
INSERT INTO `cmf_admin_menu` VALUES (32, 29, 1, 0, 10000, 'admin', 'Nav', 'edit', '', '编辑导航', '', '编辑导航');
INSERT INTO `cmf_admin_menu` VALUES (33, 29, 2, 0, 10000, 'admin', 'Nav', 'editPost', '', '编辑导航提交保存', '', '编辑导航提交保存');
INSERT INTO `cmf_admin_menu` VALUES (34, 29, 2, 0, 10000, 'admin', 'Nav', 'delete', '', '删除导航', '', '删除导航');
INSERT INTO `cmf_admin_menu` VALUES (35, 29, 1, 0, 10000, 'admin', 'NavMenu', 'index', '', '导航菜单', '', '导航菜单');
INSERT INTO `cmf_admin_menu` VALUES (36, 35, 1, 0, 10000, 'admin', 'NavMenu', 'add', '', '添加导航菜单', '', '添加导航菜单');
INSERT INTO `cmf_admin_menu` VALUES (37, 35, 2, 0, 10000, 'admin', 'NavMenu', 'addPost', '', '添加导航菜单提交保存', '', '添加导航菜单提交保存');
INSERT INTO `cmf_admin_menu` VALUES (38, 35, 1, 0, 10000, 'admin', 'NavMenu', 'edit', '', '编辑导航菜单', '', '编辑导航菜单');
INSERT INTO `cmf_admin_menu` VALUES (39, 35, 2, 0, 10000, 'admin', 'NavMenu', 'editPost', '', '编辑导航菜单提交保存', '', '编辑导航菜单提交保存');
INSERT INTO `cmf_admin_menu` VALUES (40, 35, 2, 0, 10000, 'admin', 'NavMenu', 'delete', '', '删除导航菜单', '', '删除导航菜单');
INSERT INTO `cmf_admin_menu` VALUES (41, 35, 2, 0, 10000, 'admin', 'NavMenu', 'listOrder', '', '导航菜单排序', '', '导航菜单排序');
INSERT INTO `cmf_admin_menu` VALUES (42, 1, 1, 1, 10000, 'admin', 'Plugin', 'index', '', '插件列表', '', '插件列表');
INSERT INTO `cmf_admin_menu` VALUES (43, 42, 2, 0, 10000, 'admin', 'Plugin', 'toggle', '', '插件启用禁用', '', '插件启用禁用');
INSERT INTO `cmf_admin_menu` VALUES (44, 42, 1, 0, 10000, 'admin', 'Plugin', 'setting', '', '插件设置', '', '插件设置');
INSERT INTO `cmf_admin_menu` VALUES (45, 42, 2, 0, 10000, 'admin', 'Plugin', 'settingPost', '', '插件设置提交', '', '插件设置提交');
INSERT INTO `cmf_admin_menu` VALUES (46, 42, 2, 0, 10000, 'admin', 'Plugin', 'install', '', '插件安装', '', '插件安装');
INSERT INTO `cmf_admin_menu` VALUES (47, 42, 2, 0, 10000, 'admin', 'Plugin', 'update', '', '插件更新', '', '插件更新');
INSERT INTO `cmf_admin_menu` VALUES (48, 42, 2, 0, 10000, 'admin', 'Plugin', 'uninstall', '', '卸载插件', '', '卸载插件');
INSERT INTO `cmf_admin_menu` VALUES (49, 110, 0, 1, 10000, 'admin', 'User', 'default', '', '管理组', '', '管理组');
INSERT INTO `cmf_admin_menu` VALUES (50, 49, 1, 1, 10000, 'admin', 'Rbac', 'index', '', '角色管理', '', '角色管理');
INSERT INTO `cmf_admin_menu` VALUES (51, 50, 1, 0, 10000, 'admin', 'Rbac', 'roleAdd', '', '添加角色', '', '添加角色');
INSERT INTO `cmf_admin_menu` VALUES (52, 50, 2, 0, 10000, 'admin', 'Rbac', 'roleAddPost', '', '添加角色提交', '', '添加角色提交');
INSERT INTO `cmf_admin_menu` VALUES (53, 50, 1, 0, 10000, 'admin', 'Rbac', 'roleEdit', '', '编辑角色', '', '编辑角色');
INSERT INTO `cmf_admin_menu` VALUES (54, 50, 2, 0, 10000, 'admin', 'Rbac', 'roleEditPost', '', '编辑角色提交', '', '编辑角色提交');
INSERT INTO `cmf_admin_menu` VALUES (55, 50, 2, 0, 10000, 'admin', 'Rbac', 'roleDelete', '', '删除角色', '', '删除角色');
INSERT INTO `cmf_admin_menu` VALUES (56, 50, 1, 0, 10000, 'admin', 'Rbac', 'authorize', '', '设置角色权限', '', '设置角色权限');
INSERT INTO `cmf_admin_menu` VALUES (57, 50, 2, 0, 10000, 'admin', 'Rbac', 'authorizePost', '', '角色授权提交', '', '角色授权提交');
INSERT INTO `cmf_admin_menu` VALUES (58, 0, 1, 0, 10000, 'admin', 'RecycleBin', 'index', '', '回收站', '', '回收站');
INSERT INTO `cmf_admin_menu` VALUES (59, 58, 2, 0, 10000, 'admin', 'RecycleBin', 'restore', '', '回收站还原', '', '回收站还原');
INSERT INTO `cmf_admin_menu` VALUES (60, 58, 2, 0, 10000, 'admin', 'RecycleBin', 'delete', '', '回收站彻底删除', '', '回收站彻底删除');
INSERT INTO `cmf_admin_menu` VALUES (61, 6, 1, 1, 10000, 'admin', 'Route', 'index', '', 'URL美化', '', 'URL规则管理');
INSERT INTO `cmf_admin_menu` VALUES (62, 61, 1, 1, 10000, 'admin', 'Route', 'add', '', '添加路由规则', '', '添加路由规则');
INSERT INTO `cmf_admin_menu` VALUES (71, 6, 1, 1, 0, 'admin', 'Setting', 'site', '', '网站信息', '', '网站信息');
INSERT INTO `cmf_admin_menu` VALUES (72, 71, 2, 0, 10000, 'admin', 'Setting', 'sitePost', '', '网站信息设置提交', '', '网站信息设置提交');
INSERT INTO `cmf_admin_menu` VALUES (73, 6, 1, 0, 10000, 'admin', 'Setting', 'password', '', '密码修改', '', '密码修改');
INSERT INTO `cmf_admin_menu` VALUES (74, 73, 2, 0, 10000, 'admin', 'Setting', 'passwordPost', '', '密码修改提交', '', '密码修改提交');
INSERT INTO `cmf_admin_menu` VALUES (75, 6, 1, 1, 10000, 'admin', 'Setting', 'upload', '', '上传设置', '', '上传设置');
INSERT INTO `cmf_admin_menu` VALUES (76, 75, 2, 0, 10000, 'admin', 'Setting', 'uploadPost', '', '上传设置提交', '', '上传设置提交');
INSERT INTO `cmf_admin_menu` VALUES (77, 6, 1, 0, 10000, 'admin', 'Setting', 'clearCache', '', '清除缓存', '', '清除缓存');
INSERT INTO `cmf_admin_menu` VALUES (78, 6, 1, 1, 40, 'admin', 'Slide', 'index', '', '标签管理', '', '幻灯片管理');
INSERT INTO `cmf_admin_menu` VALUES (79, 78, 1, 0, 10000, 'admin', 'Slide', 'add', '', '添加幻灯片', '', '添加幻灯片');
INSERT INTO `cmf_admin_menu` VALUES (80, 78, 2, 0, 10000, 'admin', 'Slide', 'addPost', '', '添加幻灯片提交', '', '添加幻灯片提交');
INSERT INTO `cmf_admin_menu` VALUES (81, 78, 1, 0, 10000, 'admin', 'Slide', 'edit', '', '编辑幻灯片', '', '编辑幻灯片');
INSERT INTO `cmf_admin_menu` VALUES (82, 78, 2, 0, 10000, 'admin', 'Slide', 'editPost', '', '编辑幻灯片提交', '', '编辑幻灯片提交');
INSERT INTO `cmf_admin_menu` VALUES (83, 78, 2, 0, 10000, 'admin', 'Slide', 'delete', '', '删除幻灯片', '', '删除幻灯片');
INSERT INTO `cmf_admin_menu` VALUES (84, 78, 1, 0, 10000, 'admin', 'SlideItem', 'index', '', '幻灯片页面列表', '', '幻灯片页面列表');
INSERT INTO `cmf_admin_menu` VALUES (85, 84, 1, 0, 10000, 'admin', 'SlideItem', 'add', '', '幻灯片页面添加', '', '幻灯片页面添加');
INSERT INTO `cmf_admin_menu` VALUES (86, 84, 2, 0, 10000, 'admin', 'SlideItem', 'addPost', '', '幻灯片页面添加提交', '', '幻灯片页面添加提交');
INSERT INTO `cmf_admin_menu` VALUES (87, 84, 1, 0, 10000, 'admin', 'SlideItem', 'edit', '', '幻灯片页面编辑', '', '幻灯片页面编辑');
INSERT INTO `cmf_admin_menu` VALUES (88, 84, 2, 0, 10000, 'admin', 'SlideItem', 'editPost', '', '幻灯片页面编辑提交', '', '幻灯片页面编辑提交');
INSERT INTO `cmf_admin_menu` VALUES (89, 84, 2, 0, 10000, 'admin', 'SlideItem', 'delete', '', '幻灯片页面删除', '', '幻灯片页面删除');
INSERT INTO `cmf_admin_menu` VALUES (90, 84, 2, 0, 10000, 'admin', 'SlideItem', 'ban', '', '幻灯片页面隐藏', '', '幻灯片页面隐藏');
INSERT INTO `cmf_admin_menu` VALUES (91, 84, 2, 0, 10000, 'admin', 'SlideItem', 'cancelBan', '', '幻灯片页面显示', '', '幻灯片页面显示');
INSERT INTO `cmf_admin_menu` VALUES (92, 84, 2, 0, 10000, 'admin', 'SlideItem', 'listOrder', '', '幻灯片页面排序', '', '幻灯片页面排序');
INSERT INTO `cmf_admin_menu` VALUES (93, 6, 1, 0, 10000, 'admin', 'Storage', 'index', '', '文件存储', '', '文件存储');
INSERT INTO `cmf_admin_menu` VALUES (94, 93, 2, 0, 10000, 'admin', 'Storage', 'settingPost', '', '文件存储设置提交', '', '文件存储设置提交');
INSERT INTO `cmf_admin_menu` VALUES (95, 6, 1, 0, 20, 'admin', 'Theme', 'index', '', '模板管理', '', '模板管理');
INSERT INTO `cmf_admin_menu` VALUES (96, 95, 1, 0, 10000, 'admin', 'Theme', 'install', '', '安装模板', '', '安装模板');
INSERT INTO `cmf_admin_menu` VALUES (97, 95, 2, 0, 10000, 'admin', 'Theme', 'uninstall', '', '卸载模板', '', '卸载模板');
INSERT INTO `cmf_admin_menu` VALUES (98, 95, 2, 0, 10000, 'admin', 'Theme', 'installTheme', '', '模板安装', '', '模板安装');
INSERT INTO `cmf_admin_menu` VALUES (99, 95, 2, 0, 10000, 'admin', 'Theme', 'update', '', '模板更新', '', '模板更新');
INSERT INTO `cmf_admin_menu` VALUES (100, 95, 2, 0, 10000, 'admin', 'Theme', 'active', '', '启用模板', '', '启用模板');
INSERT INTO `cmf_admin_menu` VALUES (101, 95, 1, 0, 10000, 'admin', 'Theme', 'files', '', '模板文件列表', '', '启用模板');
INSERT INTO `cmf_admin_menu` VALUES (102, 95, 1, 0, 10000, 'admin', 'Theme', 'fileSetting', '', '模板文件设置', '', '模板文件设置');
INSERT INTO `cmf_admin_menu` VALUES (103, 95, 1, 0, 10000, 'admin', 'Theme', 'fileArrayData', '', '模板文件数组数据列表', '', '模板文件数组数据列表');
INSERT INTO `cmf_admin_menu` VALUES (104, 95, 2, 0, 10000, 'admin', 'Theme', 'fileArrayDataEdit', '', '模板文件数组数据添加编辑', '', '模板文件数组数据添加编辑');
INSERT INTO `cmf_admin_menu` VALUES (105, 95, 2, 0, 10000, 'admin', 'Theme', 'fileArrayDataEditPost', '', '模板文件数组数据添加编辑提交保存', '', '模板文件数组数据添加编辑提交保存');
INSERT INTO `cmf_admin_menu` VALUES (106, 95, 2, 0, 10000, 'admin', 'Theme', 'fileArrayDataDelete', '', '模板文件数组数据删除', '', '模板文件数组数据删除');
INSERT INTO `cmf_admin_menu` VALUES (107, 95, 2, 0, 10000, 'admin', 'Theme', 'settingPost', '', '模板文件编辑提交保存', '', '模板文件编辑提交保存');
INSERT INTO `cmf_admin_menu` VALUES (108, 95, 1, 0, 10000, 'admin', 'Theme', 'dataSource', '', '模板文件设置数据源', '', '模板文件设置数据源');
INSERT INTO `cmf_admin_menu` VALUES (109, 95, 1, 0, 10000, 'admin', 'Theme', 'design', '', '模板设计', '', '模板设计');
INSERT INTO `cmf_admin_menu` VALUES (110, 0, 0, 1, 10, 'user', 'AdminIndex', 'default', '', '用户管理', 'group', '用户管理');
INSERT INTO `cmf_admin_menu` VALUES (111, 49, 1, 1, 10000, 'admin', 'User', 'index', '', '管理员', '', '管理员管理');
INSERT INTO `cmf_admin_menu` VALUES (112, 111, 1, 0, 10000, 'admin', 'User', 'add', '', '管理员添加', '', '管理员添加');
INSERT INTO `cmf_admin_menu` VALUES (113, 111, 2, 0, 10000, 'admin', 'User', 'addPost', '', '管理员添加提交', '', '管理员添加提交');
INSERT INTO `cmf_admin_menu` VALUES (114, 111, 1, 0, 10000, 'admin', 'User', 'edit', '', '管理员编辑', '', '管理员编辑');
INSERT INTO `cmf_admin_menu` VALUES (115, 111, 2, 0, 10000, 'admin', 'User', 'editPost', '', '管理员编辑提交', '', '管理员编辑提交');
INSERT INTO `cmf_admin_menu` VALUES (116, 111, 1, 0, 10000, 'admin', 'User', 'userInfo', '', '个人信息', '', '管理员个人信息修改');
INSERT INTO `cmf_admin_menu` VALUES (117, 111, 2, 0, 10000, 'admin', 'User', 'userInfoPost', '', '管理员个人信息修改提交', '', '管理员个人信息修改提交');
INSERT INTO `cmf_admin_menu` VALUES (118, 111, 2, 0, 10000, 'admin', 'User', 'delete', '', '管理员删除', '', '管理员删除');
INSERT INTO `cmf_admin_menu` VALUES (119, 111, 2, 0, 10000, 'admin', 'User', 'ban', '', '停用管理员', '', '停用管理员');
INSERT INTO `cmf_admin_menu` VALUES (120, 111, 2, 0, 10000, 'admin', 'User', 'cancelBan', '', '启用管理员', '', '启用管理员');
INSERT INTO `cmf_admin_menu` VALUES (121, 71, 1, 0, 10000, 'user', 'AdminAsset', 'index', '', '资源管理', 'file', '资源管理列表');
INSERT INTO `cmf_admin_menu` VALUES (122, 121, 2, 0, 10000, 'user', 'AdminAsset', 'delete', '', '删除文件', '', '删除文件');
INSERT INTO `cmf_admin_menu` VALUES (123, 110, 0, 1, 10000, 'user', 'AdminIndex', 'default1', '', '用户组', '', '用户组');
INSERT INTO `cmf_admin_menu` VALUES (124, 123, 1, 1, 10000, 'user', 'AdminIndex', 'index', '', '本站用户', '', '本站用户');
INSERT INTO `cmf_admin_menu` VALUES (125, 124, 2, 0, 10000, 'user', 'AdminIndex', 'ban', '', '本站用户拉黑', '', '本站用户拉黑');
INSERT INTO `cmf_admin_menu` VALUES (126, 124, 2, 0, 10000, 'user', 'AdminIndex', 'cancelBan', '', '本站用户启用', '', '本站用户启用');
INSERT INTO `cmf_admin_menu` VALUES (127, 123, 1, 1, 10000, 'user', 'AdminOauth', 'index', '', '第三方用户', '', '第三方用户');
INSERT INTO `cmf_admin_menu` VALUES (128, 127, 2, 0, 10000, 'user', 'AdminOauth', 'delete', '', '删除第三方用户绑定', '', '删除第三方用户绑定');
INSERT INTO `cmf_admin_menu` VALUES (129, 6, 1, 0, 10000, 'user', 'AdminUserAction', 'index', '', '用户操作管理', '', '用户操作管理');
INSERT INTO `cmf_admin_menu` VALUES (130, 129, 1, 0, 10000, 'user', 'AdminUserAction', 'edit', '', '编辑用户操作', '', '编辑用户操作');
INSERT INTO `cmf_admin_menu` VALUES (131, 129, 2, 0, 10000, 'user', 'AdminUserAction', 'editPost', '', '编辑用户操作提交', '', '编辑用户操作提交');
INSERT INTO `cmf_admin_menu` VALUES (132, 129, 1, 0, 10000, 'user', 'AdminUserAction', 'sync', '', '同步用户操作', '', '同步用户操作');
INSERT INTO `cmf_admin_menu` VALUES (133, 0, 1, 1, 10000, 'admin', 'Pacontent', 'index', 'type=5', '单页管理', 'pencil-square-o', '内容管理');
INSERT INTO `cmf_admin_menu` VALUES (134, 0, 1, 1, 999, 'admin', 'Class', 'index', '', '分类管理', 'window-restore', '');
INSERT INTO `cmf_admin_menu` VALUES (135, 134, 1, 1, 1000, 'admin', 'Class', 'indexPacontent', 'type=1', '单页分类', '', '');
INSERT INTO `cmf_admin_menu` VALUES (136, 134, 1, 1, 100, 'admin', 'Class', 'indexNews', 'type=2', '新闻分类', '', '');
INSERT INTO `cmf_admin_menu` VALUES (137, 134, 1, 1, 10, 'admin', 'Class', 'indexProduct', 'type=3', '产品分类', '', '');
INSERT INTO `cmf_admin_menu` VALUES (138, 0, 1, 1, 10000, 'admin', 'News', 'index', 'type=6', '文章中心', 'file-text-o', '');
INSERT INTO `cmf_admin_menu` VALUES (139, 0, 1, 1, 10000, 'admin', 'Product', 'index', 'type=7', '产品中心', 'shopping-bag', '');
INSERT INTO `cmf_admin_menu` VALUES (141, 134, 1, 1, 1, 'admin', 'Class', 'indexVideo', 'type=4', '文件分类', '', '');
INSERT INTO `cmf_admin_menu` VALUES (142, 0, 1, 1, 10000, 'admin', 'Message', 'index', 'type=8', '留言板', 'comment', '');
INSERT INTO `cmf_admin_menu` VALUES (143, 0, 1, 1, 10000, 'admin', 'Video', 'index', 'type=9', '文件管理', 'file-video-o', '');
INSERT INTO `cmf_admin_menu` VALUES (144, 0, 1, 1, 10000, 'admin', 'Recruit', 'index', '', '招聘管理', 'user', '');

-- ----------------------------
-- Table structure for cmf_asset
-- ----------------------------
DROP TABLE IF EXISTS `cmf_asset`;
CREATE TABLE `cmf_asset`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户id',
  `file_size` bigint(20) UNSIGNED NOT NULL DEFAULT 0 COMMENT '文件大小,单位B',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '上传时间',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '状态;1:可用,0:不可用',
  `download_times` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '下载次数',
  `file_key` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文件惟一码',
  `filename` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文件名',
  `file_path` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文件路径,相对于upload目录,可以为url',
  `file_md5` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文件md5值',
  `file_sha1` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `suffix` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '文件后缀名,不包括点',
  `more` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '其它详细信息,JSON格式',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '资源表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_asset
-- ----------------------------
INSERT INTO `cmf_asset` VALUES (1, 1, 70214, 1604337406, 1, 0, 'e3594edca0b9dca69898b6b14a8a3ab5236d23cab5f317670a7ee3407cdf144f', 'a02_nghj.jpg', 'admin/20201103/0d50796f79342c8ddbe8cfbe9a05dc49.jpg', 'e3594edca0b9dca69898b6b14a8a3ab5', 'afa51908fa7342bc344c498fdeffadfe57950629', 'jpg', NULL);
INSERT INTO `cmf_asset` VALUES (2, 1, 80094, 1604337407, 1, 0, '17baa2a4f31920cac1b97caf3ae3478e21fac2d0a352af16bde353dfce874427', 'a04.jpg', 'admin/20201103/a79a9f626670d03e706c876a48ebeef7.jpg', '17baa2a4f31920cac1b97caf3ae3478e', 'd513ade110f776dcfa3415a232c034e2209db5c3', 'jpg', NULL);
INSERT INTO `cmf_asset` VALUES (3, 1, 158720, 1604337901, 1, 0, '2aed1060da0b4035bfe9452f9e37df06059995a00955f51a259d86158407ba44', 'wq.jpg', 'admin/20201103/cf5d60e4808cd149adb4ebbdc976b32f.jpg', '2aed1060da0b4035bfe9452f9e37df06', 'df76771d49ece83aff875febf441aea3d18c2805', 'jpg', NULL);
INSERT INTO `cmf_asset` VALUES (4, 1, 8198, 1604338117, 1, 0, 'dc8d4272b9e8455fa6443292770f2d96c62524a3e9759d0960b1dcbccee5e2f9', 'lo.png', 'admin/20201103/b63c32f9095a43f4b082309136fb08e1.png', 'dc8d4272b9e8455fa6443292770f2d96', 'd02f916113c2210bc485e95ee414470cd007e334', 'png', NULL);
INSERT INTO `cmf_asset` VALUES (5, 1, 1564, 1604338129, 1, 0, 'eb5dd6d6c569f75218641ff9874fed4835175cd3944cacd2d4dbf13c4da9ada9', 'qr_layerCBD93C6D49384C00EB150DDE618AB073.png', 'admin/20201103/6c57c59fabdb5e7fc645292ef71118d6.png', 'eb5dd6d6c569f75218641ff9874fed48', 'acee3e822c690cc9b076b8028c888a9d6a036dfd', 'png', NULL);
INSERT INTO `cmf_asset` VALUES (6, 1, 285977, 1604450484, 1, 0, '81de37d87ef3780e1c8aac340e2a691cf8be39685a9ad03d57d23bd14076de13', 'ju.jpg', 'admin/20201104/2f6ba659460ca806e7aaec90214d14cc.jpg', '81de37d87ef3780e1c8aac340e2a691c', '91772fd88c7457de6888d492282807da4ea297d7', 'jpg', NULL);
INSERT INTO `cmf_asset` VALUES (7, 1, 76512, 1604451711, 1, 0, 'aefb036f033ffce41881105347443684a75b8f7db4e3323b2bd56a7093520fea', '2_bhia.jpg', 'admin/20201104/6265f7095a88bccc21e86256ad302eff.jpg', 'aefb036f033ffce41881105347443684', '83c09afee2348ea454dcb0a84f20c4a902de5805', 'jpg', NULL);
INSERT INTO `cmf_asset` VALUES (8, 1, 196326, 1604452420, 1, 0, 'cac2bacf48b092ffc6468d3c97fe4e9091e4113b637d43be2037440165bc5f09', 'pics.jpg', 'admin/20201104/662ebf48b92bf3d9a38927e1ceb4a4e1.jpg', 'cac2bacf48b092ffc6468d3c97fe4e90', '21da51694f25da984f4fca35334e336e5183d248', 'jpg', NULL);
INSERT INTO `cmf_asset` VALUES (9, 1, 213829, 1604454565, 1, 0, '175324a2335d14aed4c59bd8946cae4749bbf30ce0c603eff48a6f41b9e2f25c', '123.jpg', 'admin/20201104/d72925a1b71a74747e4e4584b61f57e6.jpg', '175324a2335d14aed4c59bd8946cae47', '28a6610ffcbd95337ceb36c1e340b7b27b983e8f', 'jpg', NULL);
INSERT INTO `cmf_asset` VALUES (10, 1, 307188, 1604499805, 1, 0, '50652b8dd8dfcaadc2dd2656527a1b139d288f9ca93b5f99f0349e73c85ace64', '3214.jpg', 'admin/20201104/47aaa03ed80e1281932147598c97f39d.jpg', '50652b8dd8dfcaadc2dd2656527a1b13', '56b78278053f7305e1296931996fd6180b319744', 'jpg', NULL);

-- ----------------------------
-- Table structure for cmf_auth_access
-- ----------------------------
DROP TABLE IF EXISTS `cmf_auth_access`;
CREATE TABLE `cmf_auth_access`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int(10) UNSIGNED NOT NULL COMMENT '角色',
  `rule_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '规则唯一英文标识,全小写',
  `type` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '权限规则分类,请加应用前缀,如admin_',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `role_id`(`role_id`) USING BTREE,
  INDEX `rule_name`(`rule_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 99 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '权限授权表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_auth_access
-- ----------------------------
INSERT INTO `cmf_auth_access` VALUES (1, 2, 'admin/setting/default', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (2, 2, 'admin/setting/site', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (3, 2, 'admin/setting/sitepost', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (4, 2, 'user/adminasset/index', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (5, 2, 'user/adminasset/delete', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (6, 2, 'admin/mailer/index', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (7, 2, 'admin/mailer/indexpost', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (8, 2, 'admin/mailer/template', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (9, 2, 'admin/mailer/templatepost', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (10, 2, 'admin/mailer/test', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (11, 2, 'admin/theme/index', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (12, 2, 'admin/theme/install', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (13, 2, 'admin/theme/uninstall', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (14, 2, 'admin/theme/installtheme', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (15, 2, 'admin/theme/update', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (16, 2, 'admin/theme/active', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (17, 2, 'admin/theme/files', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (18, 2, 'admin/theme/filesetting', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (19, 2, 'admin/theme/filearraydata', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (20, 2, 'admin/theme/filearraydataedit', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (21, 2, 'admin/theme/filearraydataeditpost', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (22, 2, 'admin/theme/filearraydatadelete', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (23, 2, 'admin/theme/settingpost', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (24, 2, 'admin/theme/datasource', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (25, 2, 'admin/theme/design', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (26, 2, 'admin/nav/index', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (27, 2, 'admin/nav/add', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (28, 2, 'admin/nav/addpost', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (29, 2, 'admin/nav/edit', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (30, 2, 'admin/nav/editpost', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (31, 2, 'admin/nav/delete', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (32, 2, 'admin/navmenu/index', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (33, 2, 'admin/navmenu/add', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (34, 2, 'admin/navmenu/addpost', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (35, 2, 'admin/navmenu/edit', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (36, 2, 'admin/navmenu/editpost', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (37, 2, 'admin/navmenu/delete', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (38, 2, 'admin/navmenu/listorder', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (39, 2, 'admin/slide/index', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (40, 2, 'admin/slide/add', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (41, 2, 'admin/slide/addpost', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (42, 2, 'admin/slide/edit', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (43, 2, 'admin/slide/editpost', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (44, 2, 'admin/slide/delete', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (45, 2, 'admin/slideitem/index', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (46, 2, 'admin/slideitem/add', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (47, 2, 'admin/slideitem/addpost', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (48, 2, 'admin/slideitem/edit', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (49, 2, 'admin/slideitem/editpost', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (50, 2, 'admin/slideitem/delete', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (51, 2, 'admin/slideitem/ban', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (52, 2, 'admin/slideitem/cancelban', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (53, 2, 'admin/slideitem/listorder', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (54, 2, 'admin/link/index', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (55, 2, 'admin/link/add', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (56, 2, 'admin/link/addpost', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (57, 2, 'admin/link/edit', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (58, 2, 'admin/link/editpost', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (59, 2, 'admin/link/delete', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (60, 2, 'admin/link/listorder', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (61, 2, 'admin/link/toggle', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (62, 2, 'admin/menu/index', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (63, 2, 'admin/menu/lists', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (64, 2, 'admin/menu/add', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (65, 2, 'admin/menu/addpost', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (66, 2, 'admin/menu/edit', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (67, 2, 'admin/menu/editpost', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (68, 2, 'admin/menu/delete', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (69, 2, 'admin/menu/listorder', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (70, 2, 'admin/menu/getactions', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (71, 2, 'admin/route/index', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (72, 2, 'admin/route/add', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (73, 2, 'admin/route/addpost', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (74, 2, 'admin/route/edit', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (75, 2, 'admin/route/editpost', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (76, 2, 'admin/route/delete', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (77, 2, 'admin/route/ban', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (78, 2, 'admin/route/open', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (79, 2, 'admin/route/listorder', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (80, 2, 'admin/route/select', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (81, 2, 'admin/setting/password', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (82, 2, 'admin/setting/passwordpost', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (83, 2, 'admin/setting/upload', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (84, 2, 'admin/setting/uploadpost', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (85, 2, 'admin/setting/clearcache', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (86, 2, 'admin/storage/index', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (87, 2, 'admin/storage/settingpost', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (88, 2, 'user/adminuseraction/index', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (89, 2, 'user/adminuseraction/edit', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (90, 2, 'user/adminuseraction/editpost', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (91, 2, 'user/adminuseraction/sync', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (92, 2, 'admin/class/index', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (93, 2, 'admin/class/indexpacontent', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (94, 2, 'admin/class/indexnews', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (95, 2, 'admin/class/indexproduct', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (96, 2, 'admin/class/indexvideo', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (97, 2, 'admin/news/index', 'admin_url');
INSERT INTO `cmf_auth_access` VALUES (98, 2, 'admin/product/index', 'admin_url');

-- ----------------------------
-- Table structure for cmf_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `cmf_auth_rule`;
CREATE TABLE `cmf_auth_rule`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '规则id,自增主键',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '是否有效(0:无效,1:有效)',
  `app` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '规则所属app',
  `type` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '权限规则分类，请加应用前缀,如admin_',
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '规则唯一英文标识,全小写',
  `param` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '额外url参数',
  `title` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '规则描述',
  `condition` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '规则附加条件',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name`(`name`) USING BTREE,
  INDEX `module`(`app`, `status`, `type`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 145 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '权限规则表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_auth_rule
-- ----------------------------
INSERT INTO `cmf_auth_rule` VALUES (1, 1, 'admin', 'admin_url', 'admin/Hook/index', '', '钩子管理', '');
INSERT INTO `cmf_auth_rule` VALUES (2, 1, 'admin', 'admin_url', 'admin/Hook/plugins', '', '钩子插件管理', '');
INSERT INTO `cmf_auth_rule` VALUES (3, 1, 'admin', 'admin_url', 'admin/Hook/pluginListOrder', '', '钩子插件排序', '');
INSERT INTO `cmf_auth_rule` VALUES (4, 1, 'admin', 'admin_url', 'admin/Hook/sync', '', '同步钩子', '');
INSERT INTO `cmf_auth_rule` VALUES (5, 1, 'admin', 'admin_url', 'admin/Link/index', '', '友情链接', '');
INSERT INTO `cmf_auth_rule` VALUES (6, 1, 'admin', 'admin_url', 'admin/Link/add', '', '添加友情链接', '');
INSERT INTO `cmf_auth_rule` VALUES (7, 1, 'admin', 'admin_url', 'admin/Link/addPost', '', '添加友情链接提交保存', '');
INSERT INTO `cmf_auth_rule` VALUES (8, 1, 'admin', 'admin_url', 'admin/Link/edit', '', '编辑友情链接', '');
INSERT INTO `cmf_auth_rule` VALUES (9, 1, 'admin', 'admin_url', 'admin/Link/editPost', '', '编辑友情链接提交保存', '');
INSERT INTO `cmf_auth_rule` VALUES (10, 1, 'admin', 'admin_url', 'admin/Link/delete', '', '删除友情链接', '');
INSERT INTO `cmf_auth_rule` VALUES (11, 1, 'admin', 'admin_url', 'admin/Link/listOrder', '', '友情链接排序', '');
INSERT INTO `cmf_auth_rule` VALUES (12, 1, 'admin', 'admin_url', 'admin/Link/toggle', '', '友情链接显示隐藏', '');
INSERT INTO `cmf_auth_rule` VALUES (13, 1, 'admin', 'admin_url', 'admin/Mailer/index', '', '邮箱配置', '');
INSERT INTO `cmf_auth_rule` VALUES (14, 1, 'admin', 'admin_url', 'admin/Mailer/indexPost', '', '邮箱配置提交保存', '');
INSERT INTO `cmf_auth_rule` VALUES (15, 1, 'admin', 'admin_url', 'admin/Mailer/template', '', '邮件模板', '');
INSERT INTO `cmf_auth_rule` VALUES (16, 1, 'admin', 'admin_url', 'admin/Mailer/templatePost', '', '邮件模板提交', '');
INSERT INTO `cmf_auth_rule` VALUES (17, 1, 'admin', 'admin_url', 'admin/Mailer/test', '', '邮件发送测试', '');
INSERT INTO `cmf_auth_rule` VALUES (18, 1, 'admin', 'admin_url', 'admin/Menu/index', '', '后台菜单', '');
INSERT INTO `cmf_auth_rule` VALUES (19, 1, 'admin', 'admin_url', 'admin/Menu/lists', '', '所有菜单', '');
INSERT INTO `cmf_auth_rule` VALUES (20, 1, 'admin', 'admin_url', 'admin/Menu/add', '', '后台菜单添加', '');
INSERT INTO `cmf_auth_rule` VALUES (21, 1, 'admin', 'admin_url', 'admin/Menu/addPost', '', '后台菜单添加提交保存', '');
INSERT INTO `cmf_auth_rule` VALUES (22, 1, 'admin', 'admin_url', 'admin/Menu/edit', '', '后台菜单编辑', '');
INSERT INTO `cmf_auth_rule` VALUES (23, 1, 'admin', 'admin_url', 'admin/Menu/editPost', '', '后台菜单编辑提交保存', '');
INSERT INTO `cmf_auth_rule` VALUES (24, 1, 'admin', 'admin_url', 'admin/Menu/delete', '', '后台菜单删除', '');
INSERT INTO `cmf_auth_rule` VALUES (25, 1, 'admin', 'admin_url', 'admin/Menu/listOrder', '', '后台菜单排序', '');
INSERT INTO `cmf_auth_rule` VALUES (26, 1, 'admin', 'admin_url', 'admin/Menu/getActions', '', '导入新后台菜单', '');
INSERT INTO `cmf_auth_rule` VALUES (27, 1, 'admin', 'admin_url', 'admin/Nav/index', '', '导航管理', '');
INSERT INTO `cmf_auth_rule` VALUES (28, 1, 'admin', 'admin_url', 'admin/Nav/add', '', '添加导航', '');
INSERT INTO `cmf_auth_rule` VALUES (29, 1, 'admin', 'admin_url', 'admin/Nav/addPost', '', '添加导航提交保存', '');
INSERT INTO `cmf_auth_rule` VALUES (30, 1, 'admin', 'admin_url', 'admin/Nav/edit', '', '编辑导航', '');
INSERT INTO `cmf_auth_rule` VALUES (31, 1, 'admin', 'admin_url', 'admin/Nav/editPost', '', '编辑导航提交保存', '');
INSERT INTO `cmf_auth_rule` VALUES (32, 1, 'admin', 'admin_url', 'admin/Nav/delete', '', '删除导航', '');
INSERT INTO `cmf_auth_rule` VALUES (33, 1, 'admin', 'admin_url', 'admin/NavMenu/index', '', '导航菜单', '');
INSERT INTO `cmf_auth_rule` VALUES (34, 1, 'admin', 'admin_url', 'admin/NavMenu/add', '', '添加导航菜单', '');
INSERT INTO `cmf_auth_rule` VALUES (35, 1, 'admin', 'admin_url', 'admin/NavMenu/addPost', '', '添加导航菜单提交保存', '');
INSERT INTO `cmf_auth_rule` VALUES (36, 1, 'admin', 'admin_url', 'admin/NavMenu/edit', '', '编辑导航菜单', '');
INSERT INTO `cmf_auth_rule` VALUES (37, 1, 'admin', 'admin_url', 'admin/NavMenu/editPost', '', '编辑导航菜单提交保存', '');
INSERT INTO `cmf_auth_rule` VALUES (38, 1, 'admin', 'admin_url', 'admin/NavMenu/delete', '', '删除导航菜单', '');
INSERT INTO `cmf_auth_rule` VALUES (39, 1, 'admin', 'admin_url', 'admin/NavMenu/listOrder', '', '导航菜单排序', '');
INSERT INTO `cmf_auth_rule` VALUES (40, 1, 'admin', 'admin_url', 'admin/Plugin/default', '', '插件中心', '');
INSERT INTO `cmf_auth_rule` VALUES (41, 1, 'admin', 'admin_url', 'admin/Plugin/index', '', '插件列表', '');
INSERT INTO `cmf_auth_rule` VALUES (42, 1, 'admin', 'admin_url', 'admin/Plugin/toggle', '', '插件启用禁用', '');
INSERT INTO `cmf_auth_rule` VALUES (43, 1, 'admin', 'admin_url', 'admin/Plugin/setting', '', '插件设置', '');
INSERT INTO `cmf_auth_rule` VALUES (44, 1, 'admin', 'admin_url', 'admin/Plugin/settingPost', '', '插件设置提交', '');
INSERT INTO `cmf_auth_rule` VALUES (45, 1, 'admin', 'admin_url', 'admin/Plugin/install', '', '插件安装', '');
INSERT INTO `cmf_auth_rule` VALUES (46, 1, 'admin', 'admin_url', 'admin/Plugin/update', '', '插件更新', '');
INSERT INTO `cmf_auth_rule` VALUES (47, 1, 'admin', 'admin_url', 'admin/Plugin/uninstall', '', '卸载插件', '');
INSERT INTO `cmf_auth_rule` VALUES (48, 1, 'admin', 'admin_url', 'admin/Rbac/index', '', '角色管理', '');
INSERT INTO `cmf_auth_rule` VALUES (49, 1, 'admin', 'admin_url', 'admin/Rbac/roleAdd', '', '添加角色', '');
INSERT INTO `cmf_auth_rule` VALUES (50, 1, 'admin', 'admin_url', 'admin/Rbac/roleAddPost', '', '添加角色提交', '');
INSERT INTO `cmf_auth_rule` VALUES (51, 1, 'admin', 'admin_url', 'admin/Rbac/roleEdit', '', '编辑角色', '');
INSERT INTO `cmf_auth_rule` VALUES (52, 1, 'admin', 'admin_url', 'admin/Rbac/roleEditPost', '', '编辑角色提交', '');
INSERT INTO `cmf_auth_rule` VALUES (53, 1, 'admin', 'admin_url', 'admin/Rbac/roleDelete', '', '删除角色', '');
INSERT INTO `cmf_auth_rule` VALUES (54, 1, 'admin', 'admin_url', 'admin/Rbac/authorize', '', '设置角色权限', '');
INSERT INTO `cmf_auth_rule` VALUES (55, 1, 'admin', 'admin_url', 'admin/Rbac/authorizePost', '', '角色授权提交', '');
INSERT INTO `cmf_auth_rule` VALUES (56, 1, 'admin', 'admin_url', 'admin/RecycleBin/index', '', '回收站', '');
INSERT INTO `cmf_auth_rule` VALUES (57, 1, 'admin', 'admin_url', 'admin/RecycleBin/restore', '', '回收站还原', '');
INSERT INTO `cmf_auth_rule` VALUES (58, 1, 'admin', 'admin_url', 'admin/RecycleBin/delete', '', '回收站彻底删除', '');
INSERT INTO `cmf_auth_rule` VALUES (59, 1, 'admin', 'admin_url', 'admin/Route/index', '', 'URL美化', '');
INSERT INTO `cmf_auth_rule` VALUES (60, 1, 'admin', 'admin_url', 'admin/Route/add', '', '添加路由规则', '');
INSERT INTO `cmf_auth_rule` VALUES (61, 1, 'admin', 'admin_url', 'admin/Route/addPost', '', '添加路由规则提交', '');
INSERT INTO `cmf_auth_rule` VALUES (62, 1, 'admin', 'admin_url', 'admin/Route/edit', '', '路由规则编辑', '');
INSERT INTO `cmf_auth_rule` VALUES (63, 1, 'admin', 'admin_url', 'admin/Route/editPost', '', '路由规则编辑提交', '');
INSERT INTO `cmf_auth_rule` VALUES (64, 1, 'admin', 'admin_url', 'admin/Route/delete', '', '路由规则删除', '');
INSERT INTO `cmf_auth_rule` VALUES (65, 1, 'admin', 'admin_url', 'admin/Route/ban', '', '路由规则禁用', '');
INSERT INTO `cmf_auth_rule` VALUES (66, 1, 'admin', 'admin_url', 'admin/Route/open', '', '路由规则启用', '');
INSERT INTO `cmf_auth_rule` VALUES (67, 1, 'admin', 'admin_url', 'admin/Route/listOrder', '', '路由规则排序', '');
INSERT INTO `cmf_auth_rule` VALUES (68, 1, 'admin', 'admin_url', 'admin/Route/select', '', '选择URL', '');
INSERT INTO `cmf_auth_rule` VALUES (69, 1, 'admin', 'admin_url', 'admin/Setting/default', '', '设置', '');
INSERT INTO `cmf_auth_rule` VALUES (70, 1, 'admin', 'admin_url', 'admin/Setting/site', '', '网站信息', '');
INSERT INTO `cmf_auth_rule` VALUES (71, 1, 'admin', 'admin_url', 'admin/Setting/sitePost', '', '网站信息设置提交', '');
INSERT INTO `cmf_auth_rule` VALUES (72, 1, 'admin', 'admin_url', 'admin/Setting/password', '', '密码修改', '');
INSERT INTO `cmf_auth_rule` VALUES (73, 1, 'admin', 'admin_url', 'admin/Setting/passwordPost', '', '密码修改提交', '');
INSERT INTO `cmf_auth_rule` VALUES (74, 1, 'admin', 'admin_url', 'admin/Setting/upload', '', '上传设置', '');
INSERT INTO `cmf_auth_rule` VALUES (75, 1, 'admin', 'admin_url', 'admin/Setting/uploadPost', '', '上传设置提交', '');
INSERT INTO `cmf_auth_rule` VALUES (76, 1, 'admin', 'admin_url', 'admin/Setting/clearCache', '', '清除缓存', '');
INSERT INTO `cmf_auth_rule` VALUES (77, 1, 'admin', 'admin_url', 'admin/Slide/index', '', '标签管理', '');
INSERT INTO `cmf_auth_rule` VALUES (78, 1, 'admin', 'admin_url', 'admin/Slide/add', '', '添加幻灯片', '');
INSERT INTO `cmf_auth_rule` VALUES (79, 1, 'admin', 'admin_url', 'admin/Slide/addPost', '', '添加幻灯片提交', '');
INSERT INTO `cmf_auth_rule` VALUES (80, 1, 'admin', 'admin_url', 'admin/Slide/edit', '', '编辑幻灯片', '');
INSERT INTO `cmf_auth_rule` VALUES (81, 1, 'admin', 'admin_url', 'admin/Slide/editPost', '', '编辑幻灯片提交', '');
INSERT INTO `cmf_auth_rule` VALUES (82, 1, 'admin', 'admin_url', 'admin/Slide/delete', '', '删除幻灯片', '');
INSERT INTO `cmf_auth_rule` VALUES (83, 1, 'admin', 'admin_url', 'admin/SlideItem/index', '', '幻灯片页面列表', '');
INSERT INTO `cmf_auth_rule` VALUES (84, 1, 'admin', 'admin_url', 'admin/SlideItem/add', '', '幻灯片页面添加', '');
INSERT INTO `cmf_auth_rule` VALUES (85, 1, 'admin', 'admin_url', 'admin/SlideItem/addPost', '', '幻灯片页面添加提交', '');
INSERT INTO `cmf_auth_rule` VALUES (86, 1, 'admin', 'admin_url', 'admin/SlideItem/edit', '', '幻灯片页面编辑', '');
INSERT INTO `cmf_auth_rule` VALUES (87, 1, 'admin', 'admin_url', 'admin/SlideItem/editPost', '', '幻灯片页面编辑提交', '');
INSERT INTO `cmf_auth_rule` VALUES (88, 1, 'admin', 'admin_url', 'admin/SlideItem/delete', '', '幻灯片页面删除', '');
INSERT INTO `cmf_auth_rule` VALUES (89, 1, 'admin', 'admin_url', 'admin/SlideItem/ban', '', '幻灯片页面隐藏', '');
INSERT INTO `cmf_auth_rule` VALUES (90, 1, 'admin', 'admin_url', 'admin/SlideItem/cancelBan', '', '幻灯片页面显示', '');
INSERT INTO `cmf_auth_rule` VALUES (91, 1, 'admin', 'admin_url', 'admin/SlideItem/listOrder', '', '幻灯片页面排序', '');
INSERT INTO `cmf_auth_rule` VALUES (92, 1, 'admin', 'admin_url', 'admin/Storage/index', '', '文件存储', '');
INSERT INTO `cmf_auth_rule` VALUES (93, 1, 'admin', 'admin_url', 'admin/Storage/settingPost', '', '文件存储设置提交', '');
INSERT INTO `cmf_auth_rule` VALUES (94, 1, 'admin', 'admin_url', 'admin/Theme/index', '', '模板管理', '');
INSERT INTO `cmf_auth_rule` VALUES (95, 1, 'admin', 'admin_url', 'admin/Theme/install', '', '安装模板', '');
INSERT INTO `cmf_auth_rule` VALUES (96, 1, 'admin', 'admin_url', 'admin/Theme/uninstall', '', '卸载模板', '');
INSERT INTO `cmf_auth_rule` VALUES (97, 1, 'admin', 'admin_url', 'admin/Theme/installTheme', '', '模板安装', '');
INSERT INTO `cmf_auth_rule` VALUES (98, 1, 'admin', 'admin_url', 'admin/Theme/update', '', '模板更新', '');
INSERT INTO `cmf_auth_rule` VALUES (99, 1, 'admin', 'admin_url', 'admin/Theme/active', '', '启用模板', '');
INSERT INTO `cmf_auth_rule` VALUES (100, 1, 'admin', 'admin_url', 'admin/Theme/files', '', '模板文件列表', '');
INSERT INTO `cmf_auth_rule` VALUES (101, 1, 'admin', 'admin_url', 'admin/Theme/fileSetting', '', '模板文件设置', '');
INSERT INTO `cmf_auth_rule` VALUES (102, 1, 'admin', 'admin_url', 'admin/Theme/fileArrayData', '', '模板文件数组数据列表', '');
INSERT INTO `cmf_auth_rule` VALUES (103, 1, 'admin', 'admin_url', 'admin/Theme/fileArrayDataEdit', '', '模板文件数组数据添加编辑', '');
INSERT INTO `cmf_auth_rule` VALUES (104, 1, 'admin', 'admin_url', 'admin/Theme/fileArrayDataEditPost', '', '模板文件数组数据添加编辑提交保存', '');
INSERT INTO `cmf_auth_rule` VALUES (105, 1, 'admin', 'admin_url', 'admin/Theme/fileArrayDataDelete', '', '模板文件数组数据删除', '');
INSERT INTO `cmf_auth_rule` VALUES (106, 1, 'admin', 'admin_url', 'admin/Theme/settingPost', '', '模板文件编辑提交保存', '');
INSERT INTO `cmf_auth_rule` VALUES (107, 1, 'admin', 'admin_url', 'admin/Theme/dataSource', '', '模板文件设置数据源', '');
INSERT INTO `cmf_auth_rule` VALUES (108, 1, 'admin', 'admin_url', 'admin/Theme/design', '', '模板设计', '');
INSERT INTO `cmf_auth_rule` VALUES (109, 1, 'admin', 'admin_url', 'admin/User/default', '', '管理组', '');
INSERT INTO `cmf_auth_rule` VALUES (110, 1, 'admin', 'admin_url', 'admin/User/index', '', '管理员', '');
INSERT INTO `cmf_auth_rule` VALUES (111, 1, 'admin', 'admin_url', 'admin/User/add', '', '管理员添加', '');
INSERT INTO `cmf_auth_rule` VALUES (112, 1, 'admin', 'admin_url', 'admin/User/addPost', '', '管理员添加提交', '');
INSERT INTO `cmf_auth_rule` VALUES (113, 1, 'admin', 'admin_url', 'admin/User/edit', '', '管理员编辑', '');
INSERT INTO `cmf_auth_rule` VALUES (114, 1, 'admin', 'admin_url', 'admin/User/editPost', '', '管理员编辑提交', '');
INSERT INTO `cmf_auth_rule` VALUES (115, 1, 'admin', 'admin_url', 'admin/User/userInfo', '', '个人信息', '');
INSERT INTO `cmf_auth_rule` VALUES (116, 1, 'admin', 'admin_url', 'admin/User/userInfoPost', '', '管理员个人信息修改提交', '');
INSERT INTO `cmf_auth_rule` VALUES (117, 1, 'admin', 'admin_url', 'admin/User/delete', '', '管理员删除', '');
INSERT INTO `cmf_auth_rule` VALUES (118, 1, 'admin', 'admin_url', 'admin/User/ban', '', '停用管理员', '');
INSERT INTO `cmf_auth_rule` VALUES (119, 1, 'admin', 'admin_url', 'admin/User/cancelBan', '', '启用管理员', '');
INSERT INTO `cmf_auth_rule` VALUES (120, 1, 'user', 'admin_url', 'user/AdminAsset/index', '', '资源管理', '');
INSERT INTO `cmf_auth_rule` VALUES (121, 1, 'user', 'admin_url', 'user/AdminAsset/delete', '', '删除文件', '');
INSERT INTO `cmf_auth_rule` VALUES (122, 1, 'user', 'admin_url', 'user/AdminIndex/default', '', '用户管理', '');
INSERT INTO `cmf_auth_rule` VALUES (123, 1, 'user', 'admin_url', 'user/AdminIndex/default1', '', '用户组', '');
INSERT INTO `cmf_auth_rule` VALUES (124, 1, 'user', 'admin_url', 'user/AdminIndex/index', '', '本站用户', '');
INSERT INTO `cmf_auth_rule` VALUES (125, 1, 'user', 'admin_url', 'user/AdminIndex/ban', '', '本站用户拉黑', '');
INSERT INTO `cmf_auth_rule` VALUES (126, 1, 'user', 'admin_url', 'user/AdminIndex/cancelBan', '', '本站用户启用', '');
INSERT INTO `cmf_auth_rule` VALUES (127, 1, 'user', 'admin_url', 'user/AdminOauth/index', '', '第三方用户', '');
INSERT INTO `cmf_auth_rule` VALUES (128, 1, 'user', 'admin_url', 'user/AdminOauth/delete', '', '删除第三方用户绑定', '');
INSERT INTO `cmf_auth_rule` VALUES (129, 1, 'user', 'admin_url', 'user/AdminUserAction/index', '', '用户操作管理', '');
INSERT INTO `cmf_auth_rule` VALUES (130, 1, 'user', 'admin_url', 'user/AdminUserAction/edit', '', '编辑用户操作', '');
INSERT INTO `cmf_auth_rule` VALUES (131, 1, 'user', 'admin_url', 'user/AdminUserAction/editPost', '', '编辑用户操作提交', '');
INSERT INTO `cmf_auth_rule` VALUES (132, 1, 'user', 'admin_url', 'user/AdminUserAction/sync', '', '同步用户操作', '');
INSERT INTO `cmf_auth_rule` VALUES (133, 1, 'admin', 'admin_url', 'admin/Pacontent/index', 'type=5', '单页管理', '');
INSERT INTO `cmf_auth_rule` VALUES (134, 1, 'admin', 'admin_url', 'admin/Class/index', '', '分类管理', '');
INSERT INTO `cmf_auth_rule` VALUES (135, 1, 'admin', 'admin_url', 'admin/Class/indexPacontent', 'type=1', '单页分类', '');
INSERT INTO `cmf_auth_rule` VALUES (136, 1, 'admin', 'admin_url', 'admin/Class/indexNews', 'type=2', '新闻分类', '');
INSERT INTO `cmf_auth_rule` VALUES (137, 1, 'admin', 'admin_url', 'admin/Class/indexProduct', 'type=3', '产品分类', '');
INSERT INTO `cmf_auth_rule` VALUES (138, 1, 'admin', 'admin_url', 'admin/News/index', 'type=6', '文章中心', '');
INSERT INTO `cmf_auth_rule` VALUES (139, 1, 'admin', 'admin_url', 'admin/Product/index', 'type=7', '产品中心', '');
INSERT INTO `cmf_auth_rule` VALUES (140, 1, 'admin', 'admin_url', 'admin/Test/index', '', '测试', '');
INSERT INTO `cmf_auth_rule` VALUES (141, 1, 'admin', 'admin_url', 'admin/Class/indexVideo', 'type=4', '文件分类', '');
INSERT INTO `cmf_auth_rule` VALUES (142, 1, 'admin', 'admin_url', 'admin/Message/index', 'type=8', '留言板', '');
INSERT INTO `cmf_auth_rule` VALUES (143, 1, 'admin', 'admin_url', 'admin/Video/index', 'type=9', '文件管理', '');
INSERT INTO `cmf_auth_rule` VALUES (144, 1, 'admin', 'admin_url', 'admin/Recruit/index', '', '招聘管理', '');

-- ----------------------------
-- Table structure for cmf_class
-- ----------------------------
DROP TABLE IF EXISTS `cmf_class`;
CREATE TABLE `cmf_class`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `type` int(11) NULL DEFAULT NULL,
  `parent_id` int(11) NULL DEFAULT NULL,
  `lang` tinyint(2) NULL DEFAULT 1,
  `order_num` int(11) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  `is_recom` tinyint(1) NULL DEFAULT NULL COMMENT '是否推荐',
  `is_suto_seo` tinyint(1) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '内容',
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `update_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `show_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 37 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_class
-- ----------------------------
INSERT INTO `cmf_class` VALUES (1, 1, 0, 1, 1, 1, 0, NULL, '首页', '', '', '1604454660', '1604337056', '1604337016');
INSERT INTO `cmf_class` VALUES (2, 1, 0, 1, 2, 1, 0, NULL, '关于我们', '', '', '1604337068', '1604337068', '1604337058');
INSERT INTO `cmf_class` VALUES (3, 1, 0, 1, 3, 1, 0, NULL, '产品展示', '', '', '1604337075', '1604337075', '1604337070');
INSERT INTO `cmf_class` VALUES (4, 1, 0, 1, 4, 1, 0, NULL, '新闻动态', '', '', '1604337083', '1604337083', '1604337077');
INSERT INTO `cmf_class` VALUES (5, 1, 0, 1, 5, 1, 0, NULL, '营销网络', '', '', '1604337089', '1604337089', '1604337085');
INSERT INTO `cmf_class` VALUES (6, 1, 0, 1, 6, 1, 0, NULL, '联系方式', '', '', '1604337094', '1604337094', '1604337091');
INSERT INTO `cmf_class` VALUES (7, 1, 0, 1, 7, 1, 0, NULL, '留言反馈', '', '', '1604337100', '1604337100', '1604337096');
INSERT INTO `cmf_class` VALUES (8, 1, 1, 1, 8, 1, 0, NULL, 'banner', '', '', '1604337116', '1604337116', '1604337109');
INSERT INTO `cmf_class` VALUES (9, 1, 1, 1, 9, 1, 0, NULL, '热门关键词', '', '', '1604337130', '1604337130', '1604337118');
INSERT INTO `cmf_class` VALUES (10, 1, 1, 1, 10, 1, 0, NULL, '公司简介', '', '', '1604337139', '1604337139', '1604337132');
INSERT INTO `cmf_class` VALUES (35, 1, 5, 1, 27, 1, 0, NULL, '营销网络图', '', '', '1604515373', '1604515345', '1604515328');
INSERT INTO `cmf_class` VALUES (12, 3, 0, 1, 1, 1, 0, NULL, '工程机械', '', '', '1604508473', '1604337305', '1604337299');
INSERT INTO `cmf_class` VALUES (13, 3, 0, 1, 2, 1, 0, NULL, '印刷机械', '', '', '1604508480', '1604337349', '1604337307');
INSERT INTO `cmf_class` VALUES (14, 2, 0, 1, 1, 1, 0, NULL, '公司新闻', '', '', '1604337503', '1604337503', '1604337495');
INSERT INTO `cmf_class` VALUES (15, 2, 0, 1, 2, 1, 0, NULL, '行业动态', '', '', '1604337510', '1604337510', '1604337505');
INSERT INTO `cmf_class` VALUES (30, 1, 1, 1, 23, 1, 0, NULL, '联系方式', '', '', '1604450680', '1604450680', '1604450653');
INSERT INTO `cmf_class` VALUES (18, 1, 0, 1, 13, 1, 0, NULL, '顶部底部侧边', '', '', '1604338285', '1604338181', '1604338176');
INSERT INTO `cmf_class` VALUES (19, 1, 18, 1, 14, 1, 0, NULL, '友情链接', '', '', '1604338208', '1604338208', '1604338195');
INSERT INTO `cmf_class` VALUES (20, 1, 18, 1, 15, 1, 0, NULL, '侧边售后热线', '', '', '1604338320', '1604338320', '1604338302');
INSERT INTO `cmf_class` VALUES (32, 1, 18, 1, 24, 1, 0, NULL, '授权信息', '', '', '1604464623', '1604464623', '1604464602');
INSERT INTO `cmf_class` VALUES (22, 1, 2, 1, 16, 1, 0, NULL, 'banner', '', '', '1604371814', '1604371814', '1604371809');
INSERT INTO `cmf_class` VALUES (23, 1, 3, 1, 17, 1, 0, NULL, 'banner', '', '', '1604371821', '1604371821', '1604371816');
INSERT INTO `cmf_class` VALUES (24, 1, 4, 1, 18, 1, 0, NULL, 'banner', '', '', '1604371828', '1604371828', '1604371823');
INSERT INTO `cmf_class` VALUES (25, 1, 5, 1, 19, 1, 0, NULL, 'banner', '', '', '1604371835', '1604371835', '1604371830');
INSERT INTO `cmf_class` VALUES (26, 1, 6, 1, 20, 1, 0, NULL, 'banner', '', '', '1604371841', '1604371841', '1604371837');
INSERT INTO `cmf_class` VALUES (27, 1, 7, 1, 21, 1, 0, NULL, 'banner', '', '', '1604371848', '1604371848', '1604371843');
INSERT INTO `cmf_class` VALUES (36, 1, 6, 1, 28, 1, 0, NULL, '联系方式文字', '', '', '1604515920', '1604515920', '1604515911');
INSERT INTO `cmf_class` VALUES (33, 1, 18, 1, 25, 1, 0, NULL, '联系方式', '', '', '1604480257', '1604480257', '1604480252');
INSERT INTO `cmf_class` VALUES (34, 1, 2, 1, 26, 1, 0, NULL, '关于我们简介', '', '', '1604499846', '1604499846', '1604499837');

-- ----------------------------
-- Table structure for cmf_comment
-- ----------------------------
DROP TABLE IF EXISTS `cmf_comment`;
CREATE TABLE `cmf_comment`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0 COMMENT '被回复的评论id',
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '发表评论的用户id',
  `to_user_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '被评论的用户id',
  `object_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '评论内容 id',
  `like_count` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '点赞数',
  `dislike_count` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '不喜欢数',
  `floor` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '楼层数',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '评论时间',
  `delete_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '删除时间',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '状态,1:已审核,0:未审核',
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '评论类型；1实名评论',
  `table_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '评论内容所在表，不带表前缀',
  `full_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '评论者昵称',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '评论者邮箱',
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '层级关系',
  `url` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '原文地址',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '评论内容',
  `more` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '扩展属性',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `table_id_status`(`table_name`, `object_id`, `status`) USING BTREE,
  INDEX `object_id`(`object_id`) USING BTREE,
  INDEX `status`(`status`) USING BTREE,
  INDEX `parent_id`(`parent_id`) USING BTREE,
  INDEX `create_time`(`create_time`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '评论表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_comment
-- ----------------------------

-- ----------------------------
-- Table structure for cmf_content
-- ----------------------------
DROP TABLE IF EXISTS `cmf_content`;
CREATE TABLE `cmf_content`  (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of cmf_content
-- ----------------------------

-- ----------------------------
-- Table structure for cmf_hook
-- ----------------------------
DROP TABLE IF EXISTS `cmf_hook`;
CREATE TABLE `cmf_hook`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '钩子类型(1:系统钩子;2:应用钩子;3:模板钩子;4:后台模板钩子)',
  `once` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否只允许一个插件运行(0:多个;1:一个)',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '钩子名称',
  `hook` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '钩子',
  `app` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '应用名(只有应用钩子才用)',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '描述',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 74 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '系统钩子表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_hook
-- ----------------------------
INSERT INTO `cmf_hook` VALUES (2, 1, 0, '应用开始', 'app_begin', 'cmf', '应用开始');
INSERT INTO `cmf_hook` VALUES (3, 1, 0, '模块初始化', 'module_init', 'cmf', '模块初始化');
INSERT INTO `cmf_hook` VALUES (4, 1, 0, '控制器开始', 'action_begin', 'cmf', '控制器开始');
INSERT INTO `cmf_hook` VALUES (5, 1, 0, '视图输出过滤', 'view_filter', 'cmf', '视图输出过滤');
INSERT INTO `cmf_hook` VALUES (6, 1, 0, '应用结束', 'app_end', 'cmf', '应用结束');
INSERT INTO `cmf_hook` VALUES (7, 1, 0, '日志write方法', 'log_write', 'cmf', '日志write方法');
INSERT INTO `cmf_hook` VALUES (8, 1, 0, '输出结束', 'response_end', 'cmf', '输出结束');
INSERT INTO `cmf_hook` VALUES (9, 1, 0, '后台控制器初始化', 'admin_init', 'cmf', '后台控制器初始化');
INSERT INTO `cmf_hook` VALUES (10, 1, 0, '前台控制器初始化', 'home_init', 'cmf', '前台控制器初始化');
INSERT INTO `cmf_hook` VALUES (11, 1, 1, '发送手机验证码', 'send_mobile_verification_code', 'cmf', '发送手机验证码');
INSERT INTO `cmf_hook` VALUES (12, 3, 0, '模板 body标签开始', 'body_start', '', '模板 body标签开始');
INSERT INTO `cmf_hook` VALUES (13, 3, 0, '模板 head标签结束前', 'before_head_end', '', '模板 head标签结束前');
INSERT INTO `cmf_hook` VALUES (14, 3, 0, '模板底部开始', 'footer_start', '', '模板底部开始');
INSERT INTO `cmf_hook` VALUES (15, 3, 0, '模板底部开始之前', 'before_footer', '', '模板底部开始之前');
INSERT INTO `cmf_hook` VALUES (16, 3, 0, '模板底部结束之前', 'before_footer_end', '', '模板底部结束之前');
INSERT INTO `cmf_hook` VALUES (17, 3, 0, '模板 body 标签结束之前', 'before_body_end', '', '模板 body 标签结束之前');
INSERT INTO `cmf_hook` VALUES (18, 3, 0, '模板左边栏开始', 'left_sidebar_start', '', '模板左边栏开始');
INSERT INTO `cmf_hook` VALUES (19, 3, 0, '模板左边栏结束之前', 'before_left_sidebar_end', '', '模板左边栏结束之前');
INSERT INTO `cmf_hook` VALUES (20, 3, 0, '模板右边栏开始', 'right_sidebar_start', '', '模板右边栏开始');
INSERT INTO `cmf_hook` VALUES (21, 3, 0, '模板右边栏结束之前', 'before_right_sidebar_end', '', '模板右边栏结束之前');
INSERT INTO `cmf_hook` VALUES (22, 3, 1, '评论区', 'comment', '', '评论区');
INSERT INTO `cmf_hook` VALUES (23, 3, 1, '留言区', 'guestbook', '', '留言区');
INSERT INTO `cmf_hook` VALUES (24, 2, 0, '后台首页仪表盘', 'admin_dashboard', 'admin', '后台首页仪表盘');
INSERT INTO `cmf_hook` VALUES (25, 4, 0, '后台模板 head标签结束前', 'admin_before_head_end', '', '后台模板 head标签结束前');
INSERT INTO `cmf_hook` VALUES (26, 4, 0, '后台模板 body 标签结束之前', 'admin_before_body_end', '', '后台模板 body 标签结束之前');
INSERT INTO `cmf_hook` VALUES (27, 2, 0, '后台登录页面', 'admin_login', 'admin', '后台登录页面');
INSERT INTO `cmf_hook` VALUES (28, 1, 1, '前台模板切换', 'switch_theme', 'cmf', '前台模板切换');
INSERT INTO `cmf_hook` VALUES (29, 3, 0, '主要内容之后', 'after_content', '', '主要内容之后');
INSERT INTO `cmf_hook` VALUES (32, 2, 1, '获取上传界面', 'fetch_upload_view', 'user', '获取上传界面');
INSERT INTO `cmf_hook` VALUES (33, 3, 0, '主要内容之前', 'before_content', 'cmf', '主要内容之前');
INSERT INTO `cmf_hook` VALUES (34, 1, 0, '日志写入完成', 'log_write_done', 'cmf', '日志写入完成');
INSERT INTO `cmf_hook` VALUES (35, 1, 1, '后台模板切换', 'switch_admin_theme', 'cmf', '后台模板切换');
INSERT INTO `cmf_hook` VALUES (36, 1, 1, '验证码图片', 'captcha_image', 'cmf', '验证码图片');
INSERT INTO `cmf_hook` VALUES (37, 2, 1, '后台模板设计界面', 'admin_theme_design_view', 'admin', '后台模板设计界面');
INSERT INTO `cmf_hook` VALUES (38, 2, 1, '后台设置网站信息界面', 'admin_setting_site_view', 'admin', '后台设置网站信息界面');
INSERT INTO `cmf_hook` VALUES (39, 2, 1, '后台清除缓存界面', 'admin_setting_clear_cache_view', 'admin', '后台清除缓存界面');
INSERT INTO `cmf_hook` VALUES (40, 2, 1, '后台导航管理界面', 'admin_nav_index_view', 'admin', '后台导航管理界面');
INSERT INTO `cmf_hook` VALUES (41, 2, 1, '后台友情链接管理界面', 'admin_link_index_view', 'admin', '后台友情链接管理界面');
INSERT INTO `cmf_hook` VALUES (42, 2, 1, '后台幻灯片管理界面', 'admin_slide_index_view', 'admin', '后台幻灯片管理界面');
INSERT INTO `cmf_hook` VALUES (43, 2, 1, '后台管理员列表界面', 'admin_user_index_view', 'admin', '后台管理员列表界面');
INSERT INTO `cmf_hook` VALUES (44, 2, 1, '后台角色管理界面', 'admin_rbac_index_view', 'admin', '后台角色管理界面');
INSERT INTO `cmf_hook` VALUES (49, 2, 1, '用户管理本站用户列表界面', 'user_admin_index_view', 'user', '用户管理本站用户列表界面');
INSERT INTO `cmf_hook` VALUES (50, 2, 1, '资源管理列表界面', 'user_admin_asset_index_view', 'user', '资源管理列表界面');
INSERT INTO `cmf_hook` VALUES (51, 2, 1, '用户管理第三方用户列表界面', 'user_admin_oauth_index_view', 'user', '用户管理第三方用户列表界面');
INSERT INTO `cmf_hook` VALUES (52, 2, 1, '后台首页界面', 'admin_index_index_view', 'admin', '后台首页界面');
INSERT INTO `cmf_hook` VALUES (53, 2, 1, '后台回收站界面', 'admin_recycle_bin_index_view', 'admin', '后台回收站界面');
INSERT INTO `cmf_hook` VALUES (54, 2, 1, '后台菜单管理界面', 'admin_menu_index_view', 'admin', '后台菜单管理界面');
INSERT INTO `cmf_hook` VALUES (55, 2, 1, '后台自定义登录是否开启钩子', 'admin_custom_login_open', 'admin', '后台自定义登录是否开启钩子');
INSERT INTO `cmf_hook` VALUES (64, 2, 1, '后台幻灯片页面列表界面', 'admin_slide_item_index_view', 'admin', '后台幻灯片页面列表界面');
INSERT INTO `cmf_hook` VALUES (65, 2, 1, '后台幻灯片页面添加界面', 'admin_slide_item_add_view', 'admin', '后台幻灯片页面添加界面');
INSERT INTO `cmf_hook` VALUES (66, 2, 1, '后台幻灯片页面编辑界面', 'admin_slide_item_edit_view', 'admin', '后台幻灯片页面编辑界面');
INSERT INTO `cmf_hook` VALUES (67, 2, 1, '后台管理员添加界面', 'admin_user_add_view', 'admin', '后台管理员添加界面');
INSERT INTO `cmf_hook` VALUES (68, 2, 1, '后台管理员编辑界面', 'admin_user_edit_view', 'admin', '后台管理员编辑界面');
INSERT INTO `cmf_hook` VALUES (69, 2, 1, '后台角色添加界面', 'admin_rbac_role_add_view', 'admin', '后台角色添加界面');
INSERT INTO `cmf_hook` VALUES (70, 2, 1, '后台角色编辑界面', 'admin_rbac_role_edit_view', 'admin', '后台角色编辑界面');
INSERT INTO `cmf_hook` VALUES (71, 2, 1, '后台角色授权界面', 'admin_rbac_authorize_view', 'admin', '后台角色授权界面');
INSERT INTO `cmf_hook` VALUES (72, 2, 1, '后台内容管理界面', 'admin_pacontent_default_view', 'admin', '后台内容管理界面');
INSERT INTO `cmf_hook` VALUES (73, 1, 0, '应用调度', 'app_dispatch', 'cmf', '应用调度');

-- ----------------------------
-- Table structure for cmf_hook_plugin
-- ----------------------------
DROP TABLE IF EXISTS `cmf_hook_plugin`;
CREATE TABLE `cmf_hook_plugin`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_num` float NOT NULL DEFAULT 10000 COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '状态(0:禁用,1:启用)',
  `hook` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '钩子名',
  `plugin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '插件',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '系统钩子插件表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_hook_plugin
-- ----------------------------

-- ----------------------------
-- Table structure for cmf_img
-- ----------------------------
DROP TABLE IF EXISTS `cmf_img`;
CREATE TABLE `cmf_img`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `order_num` int(10) UNSIGNED NULL DEFAULT NULL COMMENT '排序数',
  `is_cover` tinyint(1) UNSIGNED NULL DEFAULT 0 COMMENT '是否是封面图片。0为不是，1为是。默认为0，不是',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '未命名图片' COMMENT '图片名（前台显示图片名）',
  `origi_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '原图',
  `thumb_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '缩略图，改变质量但不改变大小',
  `note` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '备注',
  `show_time` int(10) UNSIGNED NOT NULL COMMENT '发布时间',
  `update_time` int(10) UNSIGNED NOT NULL COMMENT '更新时间',
  `create_time` int(10) UNSIGNED NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '图片表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_img
-- ----------------------------
INSERT INTO `cmf_img` VALUES (6, NULL, 0, '未命名图片', 'admin/20201103/cf5d60e4808cd149adb4ebbdc976b32f.jpg', 'admin/20201103/t_cf5d60e4808cd149adb4ebbdc976b32f.jpg', NULL, 1604337903, 1604337903, 1604337903);
INSERT INTO `cmf_img` VALUES (9, NULL, 0, '未命名图片', 'admin/20201104/2f6ba659460ca806e7aaec90214d14cc.jpg', 'admin/20201104/t_2f6ba659460ca806e7aaec90214d14cc.jpg', NULL, 1604450523, 1604450523, 1604450523);
INSERT INTO `cmf_img` VALUES (10, NULL, 0, '未命名图片', 'admin/20201104/6265f7095a88bccc21e86256ad302eff.jpg', 'admin/20201104/t_6265f7095a88bccc21e86256ad302eff.jpg', NULL, 1604452373, 1604452373, 1604452373);
INSERT INTO `cmf_img` VALUES (11, NULL, 0, '未命名图片', 'admin/20201104/662ebf48b92bf3d9a38927e1ceb4a4e1.jpg', 'admin/20201104/t_662ebf48b92bf3d9a38927e1ceb4a4e1.jpg', NULL, 1604452422, 1604452422, 1604452422);
INSERT INTO `cmf_img` VALUES (12, NULL, 0, '未命名图片', 'admin/20201104/2f6ba659460ca806e7aaec90214d14cc.jpg', 'admin/20201104/t_2f6ba659460ca806e7aaec90214d14cc.jpg', NULL, 1604454567, 1604454567, 1604454567);
INSERT INTO `cmf_img` VALUES (13, NULL, 0, '未命名图片', 'admin/20201104/d72925a1b71a74747e4e4584b61f57e6.jpg', 'admin/20201104/t_d72925a1b71a74747e4e4584b61f57e6.jpg', NULL, 1604454567, 1604454567, 1604454567);
INSERT INTO `cmf_img` VALUES (14, NULL, 0, '未命名图片', 'admin/20201104/47aaa03ed80e1281932147598c97f39d.jpg', 'admin/20201104/t_47aaa03ed80e1281932147598c97f39d.jpg', NULL, 1604499807, 1604499807, 1604499807);
INSERT INTO `cmf_img` VALUES (15, NULL, 0, '未命名图片', 'admin/20201104/47aaa03ed80e1281932147598c97f39d.jpg', 'admin/20201104/t_47aaa03ed80e1281932147598c97f39d.jpg', NULL, 1604504162, 1604504162, 1604504162);
INSERT INTO `cmf_img` VALUES (19, NULL, 0, '未命名图片', 'admin/20201103/0d50796f79342c8ddbe8cfbe9a05dc49.jpg', 'admin/20201103/t_0d50796f79342c8ddbe8cfbe9a05dc49.jpg', NULL, 1604509016, 1604509016, 1604509016);
INSERT INTO `cmf_img` VALUES (20, NULL, 0, '未命名图片', 'admin/20201103/a79a9f626670d03e706c876a48ebeef7.jpg', 'admin/20201103/t_a79a9f626670d03e706c876a48ebeef7.jpg', NULL, 1604509016, 1604509016, 1604509016);
INSERT INTO `cmf_img` VALUES (22, NULL, 0, '未命名图片', 'admin/20201104/662ebf48b92bf3d9a38927e1ceb4a4e1.jpg', 'admin/20201104/t_662ebf48b92bf3d9a38927e1ceb4a4e1.jpg', NULL, 1604509042, 1604509042, 1604509042);
INSERT INTO `cmf_img` VALUES (23, NULL, 0, '未命名图片', 'admin/20201103/0d50796f79342c8ddbe8cfbe9a05dc49.jpg', 'admin/20201103/t_0d50796f79342c8ddbe8cfbe9a05dc49.jpg', NULL, 1604511457, 1604511457, 1604511457);
INSERT INTO `cmf_img` VALUES (24, NULL, 0, '未命名图片', 'admin/20201103/a79a9f626670d03e706c876a48ebeef7.jpg', 'admin/20201103/t_a79a9f626670d03e706c876a48ebeef7.jpg', NULL, 1604511457, 1604511457, 1604511457);
INSERT INTO `cmf_img` VALUES (25, NULL, 0, '未命名图片', 'admin/20201104/47aaa03ed80e1281932147598c97f39d.jpg', 'admin/20201104/t_47aaa03ed80e1281932147598c97f39d.jpg', NULL, 1604513106, 1604513106, 1604513106);
INSERT INTO `cmf_img` VALUES (26, NULL, 0, '未命名图片', 'admin/20201104/47aaa03ed80e1281932147598c97f39d.jpg', 'admin/20201104/t_47aaa03ed80e1281932147598c97f39d.jpg', NULL, 1604515011, 1604515011, 1604515011);
INSERT INTO `cmf_img` VALUES (27, NULL, 0, '未命名图片', 'admin/20201104/47aaa03ed80e1281932147598c97f39d.jpg', 'admin/20201104/t_47aaa03ed80e1281932147598c97f39d.jpg', NULL, 1604515023, 1604515023, 1604515023);
INSERT INTO `cmf_img` VALUES (28, NULL, 0, '未命名图片', 'admin/20201104/47aaa03ed80e1281932147598c97f39d.jpg', 'admin/20201104/t_47aaa03ed80e1281932147598c97f39d.jpg', NULL, 1604515044, 1604515044, 1604515044);
INSERT INTO `cmf_img` VALUES (29, NULL, 0, '未命名图片', 'admin/20201103/cf5d60e4808cd149adb4ebbdc976b32f.jpg', 'admin/20201103/t_cf5d60e4808cd149adb4ebbdc976b32f.jpg', NULL, 1604515345, 1604515345, 1604515345);
INSERT INTO `cmf_img` VALUES (30, NULL, 0, '未命名图片', 'admin/20201103/a79a9f626670d03e706c876a48ebeef7.jpg', 'admin/20201103/t_a79a9f626670d03e706c876a48ebeef7.jpg', NULL, 1604538714, 1604538714, 1604538714);

-- ----------------------------
-- Table structure for cmf_img_content
-- ----------------------------
DROP TABLE IF EXISTS `cmf_img_content`;
CREATE TABLE `cmf_img_content`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `img_id` int(10) UNSIGNED NOT NULL COMMENT '外键，标签id',
  `type` int(10) UNSIGNED NOT NULL COMMENT '外键，类型id',
  `content_id` int(10) UNSIGNED NOT NULL COMMENT '外键，具体内容id。如具体某一新闻，产品的id（或者某一分类的id）',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '图片/内容关联表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_img_content
-- ----------------------------
INSERT INTO `cmf_img_content` VALUES (6, 6, 5, 13);
INSERT INTO `cmf_img_content` VALUES (10, 10, 5, 20);
INSERT INTO `cmf_img_content` VALUES (11, 11, 6, 1);
INSERT INTO `cmf_img_content` VALUES (12, 12, 5, 17);
INSERT INTO `cmf_img_content` VALUES (13, 13, 5, 17);
INSERT INTO `cmf_img_content` VALUES (14, 14, 5, 25);
INSERT INTO `cmf_img_content` VALUES (15, 15, 5, 27);
INSERT INTO `cmf_img_content` VALUES (19, 19, 7, 2);
INSERT INTO `cmf_img_content` VALUES (20, 20, 7, 2);
INSERT INTO `cmf_img_content` VALUES (22, 22, 6, 3);
INSERT INTO `cmf_img_content` VALUES (23, 23, 7, 1);
INSERT INTO `cmf_img_content` VALUES (24, 24, 7, 1);
INSERT INTO `cmf_img_content` VALUES (25, 25, 5, 28);
INSERT INTO `cmf_img_content` VALUES (26, 26, 5, 29);
INSERT INTO `cmf_img_content` VALUES (27, 27, 5, 30);
INSERT INTO `cmf_img_content` VALUES (28, 28, 5, 31);
INSERT INTO `cmf_img_content` VALUES (29, 30, 7, 3);

-- ----------------------------
-- Table structure for cmf_link
-- ----------------------------
DROP TABLE IF EXISTS `cmf_link`;
CREATE TABLE `cmf_link`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '状态;1:显示;0:不显示',
  `rating` int(11) NOT NULL DEFAULT 0 COMMENT '友情链接评级',
  `order_num` float NOT NULL DEFAULT 10000 COMMENT '排序',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '友情链接描述',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '友情链接地址',
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '友情链接名称',
  `image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '友情链接图标',
  `target` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '友情链接打开方式',
  `rel` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '链接与网站的关系',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `status`(`status`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '友情链接表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_link
-- ----------------------------

-- ----------------------------
-- Table structure for cmf_message
-- ----------------------------
DROP TABLE IF EXISTS `cmf_message`;
CREATE TABLE `cmf_message`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '姓名',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '电话',
  `create_time` int(12) NULL DEFAULT NULL COMMENT '添加时间',
  `order_num` int(10) NULL DEFAULT NULL COMMENT '排序',
  `status` int(1) NULL DEFAULT 0 COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_message
-- ----------------------------

-- ----------------------------
-- Table structure for cmf_nav
-- ----------------------------
DROP TABLE IF EXISTS `cmf_nav`;
CREATE TABLE `cmf_nav`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `is_main` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '是否为主导航;1:是;0:不是',
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '导航位置名称',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '前台导航位置表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_nav
-- ----------------------------

-- ----------------------------
-- Table structure for cmf_nav_menu
-- ----------------------------
DROP TABLE IF EXISTS `cmf_nav_menu`;
CREATE TABLE `cmf_nav_menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nav_id` int(11) NOT NULL COMMENT '导航 id',
  `parent_id` int(11) NOT NULL COMMENT '父 id',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '状态;1:显示;0:隐藏',
  `order_num` float NOT NULL DEFAULT 10000 COMMENT '排序',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单名称',
  `target` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '打开方式',
  `href` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '链接',
  `icon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '图标',
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '层级关系',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '前台导航菜单表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_nav_menu
-- ----------------------------
INSERT INTO `cmf_nav_menu` VALUES (1, 1, 0, 1, 0, '首页', '', 'home', '', '0-1');

-- ----------------------------
-- Table structure for cmf_news
-- ----------------------------
DROP TABLE IF EXISTS `cmf_news`;
CREATE TABLE `cmf_news`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(3) NULL DEFAULT NULL COMMENT '分类id',
  `lang` int(1) NULL DEFAULT 1 COMMENT '语言',
  `hits` int(11) NULL DEFAULT 0 COMMENT '点击次数',
  `order_num` int(5) NULL DEFAULT NULL COMMENT '排序',
  `status` int(1) UNSIGNED ZEROFILL NULL DEFAULT 1 COMMENT '状态',
  `is_auto_seo` tinyint(4) NULL DEFAULT 1,
  `is_recom` tinyint(1) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '内容',
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '简介',
  `other_info` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '其他信息',
  `create_time` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `update_time` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `show_time` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '发布时间，可修改',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_news
-- ----------------------------
INSERT INTO `cmf_news` VALUES (1, 14, 1, NULL, 1, 1, 1, 1, '01公司', '&lt;p&gt;XX月XX日至XX日，中国国际高新技术成果交易会在深圳会展中心隆重举行。XX集团作为装备制造产业中创新业绩突出、对产业技术进步具有重要作用的代表性企业，应国家发改委等主办方邀参加了对产业技术进步具有重要作用的代表性企业，应国家发改委等主办方邀参加了对产业技术进步具有重要作用的代表性企业，应国家发改委等主办方邀参加了&lt;/p&gt;', '', '', '1604337665', '1604452422', '1604337632');
INSERT INTO `cmf_news` VALUES (2, 14, 1, NULL, 1, 1, 1, 0, '02公司', '&lt;p&gt;XX月XX日至XX日，中国国际高新技术成果交易会在深圳会展中心隆重举行。XX集团作为装备制造产业中创新业绩突出、对产业技术进步具有重要作用的代表性企业，应国家发改委等主办方邀参加了对产业技术进步具有重要作用的代表性企业，应国家发改委等主办方邀参加了对产业技术进步具有重要作用的代表性企业，应国家发改委等主办方邀参加了&lt;/p&gt;', '', '', '1604337665', '1604536865', '1604337632');
INSERT INTO `cmf_news` VALUES (3, 15, 1, NULL, 1, 1, 1, 0, '03公司', '&lt;p&gt;XX月XX日至XX日，中国国际高新技术成果交易会在深圳会展中心隆重举行。XX集团作为装备制造产业中创新业绩突出、对产业技术进步具有重要作用的代表性企业，应国家发改委等主办方邀参加了对产业技术进步具有重要作用的代表性企业，应国家发改委等主办方邀参加了对产业技术进步具有重要作用的代表性企业，应国家发改委等主办方邀参加了&lt;/p&gt;', '', '', '1604337665', '1604509042', '1604337632');
INSERT INTO `cmf_news` VALUES (4, 15, 1, NULL, 1, 1, 1, 1, '04公司', '&lt;p&gt;XX月XX日至XX日，中国国际高新技术成果交易会在深圳会展中心隆重举行。XX集团作为装备制造产业中创新业绩突出、对产业技术进步具有重要作用的代表性企业，应国家发改委等主办方邀参加了对产业技术进步具有重要作用的代表性企业，应国家发改委等主办方邀参加了对产业技术进步具有重要作用的代表性企业，应国家发改委等主办方邀参加了&lt;/p&gt;', '', '', '1604337665', '1604337707', '1604337632');

-- ----------------------------
-- Table structure for cmf_option
-- ----------------------------
DROP TABLE IF EXISTS `cmf_option`;
CREATE TABLE `cmf_option`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `autoload` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '是否自动加载;1:自动加载;0:不自动加载',
  `option_name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '配置名',
  `option_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '配置值',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `option_name`(`option_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '全站配置表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of cmf_option
-- ----------------------------
INSERT INTO `cmf_option` VALUES (1, 1, 'site_info', '{\"site_name\":\"\\u5b81\\u6ce2\\u5a01\\u5eb7\\u65b0\\u6750\\u6599\\u6709\\u9650\\u516c\\u53f8\",\"site_seo_title\":\"ThinkCMF\\u5185\\u5bb9\\u7ba1\\u7406\\u6846\\u67b6\",\"site_seo_keywords\":\"ThinkCMF,php,\\u5185\\u5bb9\\u7ba1\\u7406\\u6846\\u67b6,cmf,cms,\\u7b80\\u7ea6\\u98ce, simplewind,framework\",\"site_seo_description\":\"ThinkCMF\\u662f\\u7b80\\u7ea6\\u98ce\\u7f51\\u7edc\\u79d1\\u6280\\u53d1\\u5e03\\u7684\\u4e00\\u6b3e\\u7528\\u4e8e\\u5feb\\u901f\\u5f00\\u53d1\\u7684\\u5185\\u5bb9\\u7ba1\\u7406\\u6846\\u67b6\",\"site_icp\":\"00001\",\"site_gwa\":\"\\u7248\\u6743\\u6240\\u6709\\u5b81\\u6ce2\\u5a01\\u5eb7\\u65b0\\u6750\\u6599\\u6709\\u9650\\u516c\\u53f8\\u3000\\u6d59ICP\\u5907110\\u53f7\",\"site_admin_email\":\"\",\"contact\":\"&lt;p&gt;\\u7248\\u6743\\u6240\\u6709 &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;\\u5b81\\u6ce2\\u5a01\\u5eb7\\u65b0\\u6750\\u6599\\u6709\\u9650\\u516c\\u53f8 \\u6caaICP\\u59078888XXXX\\u53f7 &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;\\u516c\\u53f8\\u5730\\u5740\\uff1a\\u5b81\\u6ce2\\u5e02\\u9ad8\\u65b0\\u533a\\u901a\\u9014\\u8def2577\\u53f7\\uff08\\u76db\\u6885\\u8def\\u53e3\\uff09&lt;\\/p&gt;&lt;p&gt;\\u7535\\u8bdd\\uff1a0574-88487082 \\/88352228 &amp;nbsp; QQ 772535115 &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;\\u90ae\\u7bb1\\uff1ajklfqy@126.com&lt;\\/p&gt;\",\"logo\":\"admin\\/20200827\\/913c49121a329e1774dc62075683b3ff.png\",\"phone\":\"110\",\"fax\":\"110\",\"mobile\":\"18888888888\",\"email\":\"1@qq.com\",\"qr\":\"admin\\/20201103\\/6c57c59fabdb5e7fc645292ef71118d6.png\",\"address_cn\":\"\\u6d59\\u6c5f\\u5b81\\u6ce2\",\"address_en\":\"zhejiang ningbo\",\"lng\":\"121.558977\",\"lat\":\"29.882388\",\"logo_en\":\"admin\\/20201103\\/b63c32f9095a43f4b082309136fb08e1.png\",\"site_name_en\":\"Weikang New Materials Co.,Ldt.\",\"logo_cn\":\"admin\\/20201103\\/b63c32f9095a43f4b082309136fb08e1.png\"}');
INSERT INTO `cmf_option` VALUES (2, 1, 'admin_dashboard_widgets', '[{\"name\":\"CmfHub\",\"is_system\":1},{\"name\":\"Contributors\",\"is_system\":1},{\"name\":\"CmfDocuments\",\"is_system\":1},{\"name\":\"MainContributors\",\"is_system\":1},{\"name\":\"Custom1\",\"is_system\":1},{\"name\":\"Custom2\",\"is_system\":1},{\"name\":\"Custom3\",\"is_system\":1},{\"name\":\"Custom4\",\"is_system\":1},{\"name\":\"Custom5\",\"is_system\":1}]');
INSERT INTO `cmf_option` VALUES (3, 1, 'upload_setting', '{\"0\":\"{\\\"max_files\\\":\\\"20\\\",\\\"chunk_size\\\":\\\"512\\\",\\\"file_types\\\":{\\\"image\\\":{\\\"upload_max_filesize\\\":\\\"10240\\\",\\\"extensions\\\":\\\"jpg,jpeg,png,gif,bmp4\\\"},\\\"video\\\":{\\\"upload_max_filesize\\\":\\\"102400\\\",\\\"extensions\\\":\\\"mp4,avi,wmv,rm,rmvb,mkv\\\"},\\\"audio\\\":{\\\"upload_max_filesize\\\":\\\"10240\\\",\\\"extensions\\\":\\\"mp3,wma,wav\\\"},\\\"file\\\":{\\\"upload_max_filesize\\\":\\\"10240\\\",\\\"extensions\\\":\\\"txt,pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar\\\"}}}\",\"max_files\":\"20\",\"chunk_size\":\"512\",\"file_types\":{\"image\":{\"upload_max_filesize\":\"102400\",\"extensions\":\"jpg,jpeg,png,gif,bmp4\"},\"video\":{\"upload_max_filesize\":\"102400\",\"extensions\":\"mp4,avi,wmv,rm,rmvb,mkv\"},\"audio\":{\"upload_max_filesize\":\"10240\",\"extensions\":\"mp3,wma,wav\"},\"file\":{\"upload_max_filesize\":\"102400\",\"extensions\":\"txt,pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar\"}}}');
INSERT INTO `cmf_option` VALUES (4, 1, 'admin_settings', '{\"admin_password\":\"\",\"admin_theme\":\"admin_simpleboot3\",\"admin_style\":\"simpleadmin\"}');
INSERT INTO `cmf_option` VALUES (5, 1, 'cmf_settings', '{\"0\":\"{\\\"banned_usernames\\\":\\\"\\\"}\",\"banned_usernames\":\"\"}');

-- ----------------------------
-- Table structure for cmf_pacontent
-- ----------------------------
DROP TABLE IF EXISTS `cmf_pacontent`;
CREATE TABLE `cmf_pacontent`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(3) NULL DEFAULT NULL COMMENT '分类id',
  `lang` int(1) NULL DEFAULT 1 COMMENT '语言',
  `order_num` int(5) NULL DEFAULT NULL COMMENT '排序',
  `status` int(1) UNSIGNED ZEROFILL NULL DEFAULT 1 COMMENT '状态',
  `is_auto_seo` tinyint(4) NULL DEFAULT 1 COMMENT '是否自动seo',
  `is_recom` tinyint(1) NULL DEFAULT NULL COMMENT '是否推荐',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '内容',
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '简介',
  `other_info` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '其他信息',
  `create_time` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `update_time` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `show_time` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '发布时间，可修改',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 33 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_pacontent
-- ----------------------------
INSERT INTO `cmf_pacontent` VALUES (1, 36, 1, 1, 1, 1, 0, '地址', '', '', '地址：宁波市高新区通途路2577号（盛梅路口）', '1604337749', '1604337749', '1604337731');
INSERT INTO `cmf_pacontent` VALUES (2, 36, 1, 2, 1, 1, 0, '电话', '', '', '0574-88487082 /88352228 QQ 772535115', '1604337767', '1604337767', '1604337751');
INSERT INTO `cmf_pacontent` VALUES (3, 36, 1, 3, 1, 1, 0, '传真', '', '', '0574-88487076 /88369223 local job listings', '1604337784', '1604337784', '1604337769');
INSERT INTO `cmf_pacontent` VALUES (4, 36, 1, 4, 1, 1, 0, '邮箱', '', '', '1@com', '1604337809', '1604337809', '1604337786');
INSERT INTO `cmf_pacontent` VALUES (5, 36, 1, 5, 1, 1, 0, '联系人', '', '', '总经理', '1604337821', '1604337821', '1604337811');
INSERT INTO `cmf_pacontent` VALUES (6, 36, 1, 6, 1, 1, 0, '手机', '', '', '13122334455', '1604337831', '1604337831', '1604337823');
INSERT INTO `cmf_pacontent` VALUES (7, 7, 1, 1, 1, 1, 0, '地址', '', '', '地址：宁波市高新区通途路2577号（盛梅路口）', '1604337749', '1604337749', '1604337731');
INSERT INTO `cmf_pacontent` VALUES (8, 7, 1, 2, 1, 1, 0, '电话', '', '', '0574-88487082 /88352228 QQ 772535115', '1604337767', '1604337767', '1604337751');
INSERT INTO `cmf_pacontent` VALUES (9, 7, 1, 3, 1, 1, 0, '传真', '', '', '0574-88487076 /88369223 local job listings', '1604337784', '1604337784', '1604337769');
INSERT INTO `cmf_pacontent` VALUES (10, 7, 1, 4, 1, 1, 0, '邮箱', '', '', '1@com', '1604337809', '1604337809', '1604337786');
INSERT INTO `cmf_pacontent` VALUES (11, 7, 1, 5, 1, 1, 0, '联系人', '', '', '总经理', '1604337821', '1604337821', '1604337811');
INSERT INTO `cmf_pacontent` VALUES (12, 7, 1, 6, 1, 1, 0, '手机', '', '', '13122334455', '1604337831', '1604337831', '1604337823');
INSERT INTO `cmf_pacontent` VALUES (14, 19, 1, 8, 1, 1, 0, '友情链接1', '', '', 'https://www.baidu.com', '1604338234', '1604338234', '1604338214');
INSERT INTO `cmf_pacontent` VALUES (15, 19, 1, 9, 1, 1, 0, '友情链接2', '', '', 'https://www.souhu.com', '1604338265', '1604338265', '1604338236');
INSERT INTO `cmf_pacontent` VALUES (16, 20, 1, 10, 1, 1, 0, '售后热线', '', '', '400-000-00000', '1604338348', '1604338348', '1604338324');
INSERT INTO `cmf_pacontent` VALUES (17, 8, 1, 11, 1, 1, 0, '首页banner', '', '', '', '1604450491', '1604454567', '1604450405');
INSERT INTO `cmf_pacontent` VALUES (18, 9, 1, 12, 1, 1, 0, '混凝土泵车', '', '', '网址', '1604450568', '1604454851', '1604450544');
INSERT INTO `cmf_pacontent` VALUES (19, 9, 1, 13, 1, 1, 0, '装载机', '', '', '网址', '1604450575', '1604454863', '1604450570');
INSERT INTO `cmf_pacontent` VALUES (20, 10, 1, 14, 1, 1, 0, '公司简介', '&lt;p&gt;主要产品有：工程起重机械、筑路机械、路面及养护机械、压实机械、铲土运输机械、挖掘机械、砼泵机械、铁路施工机械、高空消防设备、特种专用车辆、专用底盘、载重汽车等主机和工程机械基础零部件产品。其中汽车起重机、压路机、摊铺机、高空消防车、平地机。&lt;/p&gt;', '', '', '1604450637', '1604452373', '1604450588');
INSERT INTO `cmf_pacontent` VALUES (21, 30, 1, 15, 1, 1, 0, '首页联系方式', '&lt;p&gt;地址：宁波市高新区通途路2577号（盛梅路口） &amp;nbsp;&amp;nbsp;&amp;nbsp;电话：0574-88487082 /88352228&lt;/p&gt;&lt;p&gt;邮箱：jklfqy@126.com&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;QQ客服：772535115&lt;/p&gt;', '', '', '1604450956', '1604450956', '1604450946');
INSERT INTO `cmf_pacontent` VALUES (22, 32, 1, 16, 1, 1, 0, '授权信息', '', '', '宁波威康新材料有限公司 沪ICP备8888XXXX号 ', '1604464743', '1604464743', '1604464710');
INSERT INTO `cmf_pacontent` VALUES (23, 18, 1, 17, 1, 1, 0, '联系方式', '', '', '', '1604480225', '1604480225', '1604480216');
INSERT INTO `cmf_pacontent` VALUES (24, 33, 1, 18, 1, 1, 0, '联系方式', '&lt;p&gt;版权所有 &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;宁波威康新材料有限公司 沪ICP备8888XXXX号 &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;公司地址：宁波市高新区通途路2577号（盛梅路口）&lt;/p&gt;&lt;p&gt;电话：0574-88487082 /88352228 &amp;nbsp; QQ 772535115 &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;邮箱：jklfqy@126.com&lt;/p&gt;', '', '', '1604480279', '1604480279', '1604480265');
INSERT INTO `cmf_pacontent` VALUES (25, 22, 1, 19, 1, 1, 0, 'banner', '', '', '', '1604499807', '1604499807', '1604499775');
INSERT INTO `cmf_pacontent` VALUES (26, 34, 1, 20, 1, 1, 0, '图文简介', '&lt;p&gt;上海某某机械有限公司座落于制造业名城广东东莞，专业生产冷室压铸机、热室压铸机及其周边设备，广泛应用于汽车、摩托车、电子、通讯、礼品、玩具等领域。&lt;/p&gt;&lt;p&gt;经过数年的发展客户遍布广东、湖南、湖北、河南、浙江、福建、江苏、重庆、四川等地，现有总部工厂及南海、石狮、宁波、温州、苏州、常州、武汉、重庆等办事处。&lt;/p&gt;&lt;p&gt;压铸机采用欧洲和行业设计标准进行自主研发、制造,同时采用国外先进加工中心进行精密加工,确保产品设计的先进性，工艺的**性及制造的精密性。机械已形成一套完善的产品研究、开发、生产制造、品质保证及服务体系，并通过了ISO9001--2000质量体系认证。&lt;/p&gt;&lt;p&gt;上海某某机械有限公司座落于制造业名城广东东莞，专业生产冷室压铸机、热室压铸机及其周边设备，广泛应用于汽车、摩托车、电子、通讯、礼品、玩具等领域。&lt;/p&gt;&lt;p&gt;经过数年的发展客户遍布广东、湖南、湖北、河南、浙江、福建、江苏、重庆、四川等地，现有总部工厂及南海、石狮、宁波、温州、苏州、常州、武汉、重庆等办事处。&lt;/p&gt;&lt;p&gt;压铸机采用欧洲和行业设计标准进行自主研发、制造,同时采用国外先进加工中心进行精密加工,确保产品设计的先进性，工艺的**性及制造的精密性。机械已形成一套完善的产品研究、开发、生产制造、品质保证及服务体系，并通过了ISO9001--2000质量体系认证。&lt;/p&gt;&lt;p&gt;上海某某机械有限公司座落于制造业名城广东东莞，专业生产冷室压铸机、热室压铸机及其周边设备，广泛应用于汽车、摩托车、电子、通讯、礼品、玩具等领域。&lt;/p&gt;&lt;p&gt;经过数年的发展客户遍布广东、湖南、湖北、河南、浙江、福建、江苏、重庆、四川等地，现有总部工厂及南海、石狮、宁波、温州、苏州、常州、武汉、重庆等办事处。&lt;/p&gt;&lt;p&gt;压铸机采用欧洲和行业设计标准进行自主研发、制造,同时采用国外先进加工中心进行精密加工,确保产品设计的先进性，工艺的**性及制造的精密性。机械已形成一套完善的产品研究、开发、生产制造、品质保证及服务体系，并通过了ISO9001--2000质量体系认证。&lt;/p&gt;&lt;p&gt;上海某某机械有限公司座落于制造业名城广东东莞，专业生产冷室压铸机、热室压铸机及其周边设备，广泛应用于汽车、摩托车、电子、通讯、礼品、玩具等领域。&lt;/p&gt;&lt;p&gt;经过数年的发展客户遍布广东、湖南、湖北、河南、浙江、福建、江苏、重庆、四川等地，现有总部工厂及南海、石狮、宁波、温州、苏州、常州、武汉、重庆等办事处。&lt;/p&gt;&lt;p&gt;压铸机采用欧洲和行业设计标准进行自主研发、制造,同时采用国外先进加工中心进行精密加工,确保产品设计的先进性，工艺的**性及制造的精密性。机械已形成一套完善的产品研究、开发、生产制造、品质保证及服务体系，并通过了ISO9001--2000质量体系认证。&lt;/p&gt;&lt;p&gt;上海某某机械有限公司座落于制造业名城广东东莞，专业生产冷室压铸机、热室压铸机及其周边设备，广泛应用于汽车、摩托车、电子、通讯、礼品、玩具等领域。&lt;/p&gt;&lt;p&gt;经过数年的发展客户遍布广东、湖南、湖北、河南、浙江、福建、江苏、重庆、四川等地，现有总部工厂及南海、石狮、宁波、温州、苏州、常州、武汉、重庆等办事处。&lt;/p&gt;&lt;p&gt;压铸机采用欧洲和行业设计标准进行自主研发、制造,同时采用国外先进加工中心进行精密加工,确保产品设计的先进性，工艺的**性及制造的精密性。机械已形成一套完善的产品研究、开发、生产制造、品质保证及服务体系，并通过了ISO9001--2000质量体系认证。&lt;/p&gt;&lt;p&gt;上海某某机械有限公司座落于制造业名城广东东莞，专业生产冷室压铸机、热室压铸机及其周边设备，广泛应用于汽车、摩托车、电子、通讯、礼品、玩具等领域。&lt;/p&gt;&lt;p&gt;经过数年的发展客户遍布广东、湖南、湖北、河南、浙江、福建、江苏、重庆、四川等地，现有总部工厂及南海、石狮、宁波、温州、苏州、常州、武汉、重庆等办事处。&lt;/p&gt;&lt;p&gt;压铸机采用欧洲和行业设计标准进行自主研发、制造,同时采用国外先进加工中心进行精密加工,确保产品设计的先进性，工艺的**性及制造的精密性。机械已形成一套完善的产品研究、开发、生产制造、品质保证及服务体系，并通过了ISO9001--2000质量体系认证。&lt;/p&gt;&lt;p&gt;上海某某机械有限公司座落于制造业名城广东东莞，专业生产冷室压铸机、热室压铸机及其周边设备，广泛应用于汽车、摩托车、电子、通讯、礼品、玩具等领域。&lt;/p&gt;&lt;p&gt;经过数年的发展客户遍布广东、湖南、湖北、河南、浙江、福建、江苏、重庆、四川等地，现有总部工厂及南海、石狮、宁波、温州、苏州、常州、武汉、重庆等办事处。&lt;/p&gt;&lt;p&gt;压铸机采用欧洲和行业设计标准进行自主研发、制造,同时采用国外先进加工中心进行精密加工,确保产品设计的先进性，工艺的**性及制造的精密性。机械已形成一套完善的产品研究、开发、生产制造、品质保证及服务体系，并通过了ISO9001--2000质量体系认证。&lt;/p&gt;&lt;p&gt;上海某某机械有限公司座落于制造业名城广东东莞，专业生产冷室压铸机、热室压铸机及其周边设备，广泛应用于汽车、摩托车、电子、通讯、礼品、玩具等领域。&lt;/p&gt;&lt;p&gt;经过数年的发展客户遍布广东、湖南、湖北、河南、浙江、福建、江苏、重庆、四川等地，现有总部工厂及南海、石狮、宁波、温州、苏州、常州、武汉、重庆等办事处。&lt;/p&gt;&lt;p&gt;压铸机采用欧洲和行业设计标准进行自主研发、制造,同时采用国外先进加工中心进行精密加工,确保产品设计的先进性，工艺的**性及制造的精密性。机械已形成一套完善的产品研究、开发、生产制造、品质保证及服务体系，并通过了ISO9001--2000质量体系认证。&lt;/p&gt;', '', '', '1604499877', '1604500244', '1604499849');
INSERT INTO `cmf_pacontent` VALUES (27, 23, 1, 21, 1, 1, 0, 'banner', '', '', '', '1604504162', '1604504162', '1604504145');
INSERT INTO `cmf_pacontent` VALUES (28, 24, 1, 22, 1, 1, 0, 'banner', '', '', '', '1604513106', '1604513106', '1604513092');
INSERT INTO `cmf_pacontent` VALUES (29, 25, 1, 23, 1, 1, 0, 'banner', '', '', '', '1604515011', '1604515011', '1604514999');
INSERT INTO `cmf_pacontent` VALUES (30, 26, 1, 24, 1, 1, 0, 'banner', '', '', '', '1604515023', '1604515023', '1604515013');
INSERT INTO `cmf_pacontent` VALUES (31, 27, 1, 25, 1, 1, 0, 'banner', '', '', '', '1604515044', '1604515044', '1604515025');
INSERT INTO `cmf_pacontent` VALUES (32, 35, 1, 26, 1, 1, 0, '营销网络内容', '&lt;p&gt;&lt;img src=&quot;/upload/admin/20201103/cf5d60e4808cd149adb4ebbdc976b32f.jpg&quot; title=&quot;营销网络&quot; alt=&quot;营销网络&quot;/&gt;&lt;/p&gt;', '', '', '1604515395', '1604540869', '1604515376');

-- ----------------------------
-- Table structure for cmf_plugin
-- ----------------------------
DROP TABLE IF EXISTS `cmf_plugin`;
CREATE TABLE `cmf_plugin`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '插件类型;1:网站;8:微信',
  `has_admin` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否有后台管理,0:没有;1:有',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '状态;1:开启;0:禁用',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '插件安装时间',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '插件标识名,英文字母(惟一)',
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '插件名称',
  `demo_url` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '演示地址，带协议',
  `hooks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '实现的钩子;以“,”分隔',
  `author` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '插件作者',
  `author_url` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '作者网站链接',
  `version` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '插件版本号',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '插件描述',
  `config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '插件配置',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '插件表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_plugin
-- ----------------------------

-- ----------------------------
-- Table structure for cmf_product
-- ----------------------------
DROP TABLE IF EXISTS `cmf_product`;
CREATE TABLE `cmf_product`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(3) NULL DEFAULT NULL COMMENT '分类id',
  `lang` int(1) NULL DEFAULT 1 COMMENT '语言',
  `status` tinyint(1) UNSIGNED ZEROFILL NULL DEFAULT 1 COMMENT '状态',
  `order_num` int(5) NULL DEFAULT NULL COMMENT '排序',
  `is_auto_seo` tinyint(4) NULL DEFAULT 1,
  `is_recom` tinyint(1) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '内容',
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '简介',
  `other_info` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '其他信息',
  `create_time` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `update_time` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `show_time` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_product
-- ----------------------------
INSERT INTO `cmf_product` VALUES (1, 12, 1, 1, 1, 1, 0, '切割1', '&lt;p&gt;LW221装载机是徐工集团新近向市场推出的一款高效、美观，安全、可靠的新一代机型。 ·整机设计更为合理，采用液力机械传动、四轮驱动，具备较大的驱动力和拨出起力；转弯半径小，轻便灵活，尤其适合狭窄场地作业。&lt;/p&gt;', '', '', '1604337433', '1604511457', '1604337360');
INSERT INTO `cmf_product` VALUES (2, 12, 1, 1, 2, 1, 0, '切割2', '&lt;p&gt;LW221装载机是徐工集团新近向市场推出的一款高效、美观，安全、可靠的新一代机型。 ·整机设计更为合理，采用液力机械传动、四轮驱动，具备较大的驱动力和拨出起力；转弯半径小，轻便灵活，尤其适合狭窄场地作业。&lt;/p&gt;', '', 'LW221装载机是徐工集团新近向市场推出的一款高效、美观，安全、可靠的新一代机型。 ·整机设计更为合理，采用液力机械传动、四轮驱动，具备较大的驱动力和拨出起力；转弯半径小，轻便灵活，尤其适合狭窄场地作业。', '1604337469', '1604509016', '1604337441');
INSERT INTO `cmf_product` VALUES (3, 13, 1, 1, 3, 1, 0, '切割2', '&lt;p&gt;2&lt;/p&gt;', '', '1', '1604337489', '1604538714', '1604337472');

-- ----------------------------
-- Table structure for cmf_recruit
-- ----------------------------
DROP TABLE IF EXISTS `cmf_recruit`;
CREATE TABLE `cmf_recruit`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(3) NULL DEFAULT NULL COMMENT '分类id',
  `lang` int(1) NULL DEFAULT 1 COMMENT '语言',
  `order_num` int(5) NULL DEFAULT NULL COMMENT '排序',
  `status` int(1) UNSIGNED ZEROFILL NULL DEFAULT 1 COMMENT '状态',
  `is_auto_seo` tinyint(4) NULL DEFAULT 1,
  `is_recom` tinyint(1) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '内容',
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '简介',
  `other_info` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '其他信息',
  `create_time` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `update_time` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `show_time` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '发布时间，可修改',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_recruit
-- ----------------------------

-- ----------------------------
-- Table structure for cmf_recycle_bin
-- ----------------------------
DROP TABLE IF EXISTS `cmf_recycle_bin`;
CREATE TABLE `cmf_recycle_bin`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `object_id` int(11) NULL DEFAULT 0 COMMENT '删除内容 id',
  `create_time` int(10) UNSIGNED NULL DEFAULT 0 COMMENT '创建时间',
  `table_name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '删除内容所在表名',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '删除内容名称',
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = ' 回收站' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_recycle_bin
-- ----------------------------
INSERT INTO `cmf_recycle_bin` VALUES (1, 1, 1602552388, 'slide', 'yesia', 0);
INSERT INTO `cmf_recycle_bin` VALUES (2, 6, 1603355825, 'slide', '行吧', 0);
INSERT INTO `cmf_recycle_bin` VALUES (3, 1, 1603681804, 'slide', '新闻', 0);

-- ----------------------------
-- Table structure for cmf_role
-- ----------------------------
DROP TABLE IF EXISTS `cmf_role`;
CREATE TABLE `cmf_role`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '父角色ID',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '状态;0:禁用;1:正常',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
  `order_num` float NOT NULL DEFAULT 0 COMMENT '排序',
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '角色名称',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `parent_id`(`parent_id`) USING BTREE,
  INDEX `status`(`status`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '角色表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_role
-- ----------------------------
INSERT INTO `cmf_role` VALUES (1, 0, 1, 1329633709, 1329633709, 0, '超级管理员', '拥有网站最高管理员权限！');
INSERT INTO `cmf_role` VALUES (2, 0, 1, 1329633709, 1329633709, 0, '普通管理员', '权限由最高管理员分配！');

-- ----------------------------
-- Table structure for cmf_role_user
-- ----------------------------
DROP TABLE IF EXISTS `cmf_role_user`;
CREATE TABLE `cmf_role_user`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '角色 id',
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户id',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `role_id`(`role_id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户角色对应表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_role_user
-- ----------------------------
INSERT INTO `cmf_role_user` VALUES (3, 2, 2);

-- ----------------------------
-- Table structure for cmf_route
-- ----------------------------
DROP TABLE IF EXISTS `cmf_route`;
CREATE TABLE `cmf_route`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '路由id',
  `order_num` float NOT NULL DEFAULT 10000 COMMENT '排序',
  `status` tinyint(2) NOT NULL DEFAULT 1 COMMENT '状态;1:启用,0:不启用',
  `type` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'URL规则类型;1:用户自定义;2:别名添加',
  `full_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '完整url',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '实际显示的url',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = 'url路由表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_route
-- ----------------------------

-- ----------------------------
-- Table structure for cmf_seo
-- ----------------------------
DROP TABLE IF EXISTS `cmf_seo`;
CREATE TABLE `cmf_seo`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `title` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '页面标题，用于seo。',
  `keywords` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '页面关键词，用于seo。',
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '页面描述，用于seo。',
  `update_time` int(10) UNSIGNED NOT NULL COMMENT '更新时间',
  `create_time` int(10) UNSIGNED NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'seo表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_seo
-- ----------------------------
INSERT INTO `cmf_seo` VALUES (1, '宁波威康新材料有限公司', '到后台分类管理-单页分类-首页中编辑 ', '不手动则会自动生成', 1604454660, 1604454660);

-- ----------------------------
-- Table structure for cmf_seo_content
-- ----------------------------
DROP TABLE IF EXISTS `cmf_seo_content`;
CREATE TABLE `cmf_seo_content`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `seo_id` int(11) NULL DEFAULT NULL,
  `type` int(10) UNSIGNED NOT NULL COMMENT '外键，类型id',
  `content_id` int(10) UNSIGNED NOT NULL COMMENT '外键，具体内容id。如具体某一新闻，产品的id（或者某一分类的id）',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'seo表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_seo_content
-- ----------------------------
INSERT INTO `cmf_seo_content` VALUES (1, 1, 1, 1);

-- ----------------------------
-- Table structure for cmf_slide
-- ----------------------------
DROP TABLE IF EXISTS `cmf_slide`;
CREATE TABLE `cmf_slide`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '状态,1:显示,0不显示',
  `delete_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '删除时间',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '幻灯片分类',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '分类备注',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '幻灯片表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_slide
-- ----------------------------

-- ----------------------------
-- Table structure for cmf_slide_item
-- ----------------------------
DROP TABLE IF EXISTS `cmf_slide_item`;
CREATE TABLE `cmf_slide_item`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `slide_id` int(11) NOT NULL DEFAULT 0 COMMENT '幻灯片id',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '状态,1:显示;0:隐藏',
  `order_num` float NOT NULL DEFAULT 10000 COMMENT '排序',
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '幻灯片名称',
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '幻灯片图片',
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '幻灯片链接',
  `target` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '友情链接打开方式',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '幻灯片描述',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '幻灯片内容',
  `more` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '扩展信息',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `slide_id`(`slide_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '幻灯片子项表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_slide_item
-- ----------------------------

-- ----------------------------
-- Table structure for cmf_tag
-- ----------------------------
DROP TABLE IF EXISTS `cmf_tag`;
CREATE TABLE `cmf_tag`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标签名',
  `update_time` int(11) NULL DEFAULT NULL,
  `create_time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '标签表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_tag
-- ----------------------------
INSERT INTO `cmf_tag` VALUES (1, '标签1', 1603954903, 1603681781);
INSERT INTO `cmf_tag` VALUES (2, '标签2', 1603954910, 1603954910);
INSERT INTO `cmf_tag` VALUES (3, '标签3', 1603954919, 1603954919);

-- ----------------------------
-- Table structure for cmf_tag_content
-- ----------------------------
DROP TABLE IF EXISTS `cmf_tag_content`;
CREATE TABLE `cmf_tag_content`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `tag_id` int(10) UNSIGNED NOT NULL COMMENT '外键，标签id',
  `type` int(10) UNSIGNED NOT NULL COMMENT '外键，类型id',
  `content_id` int(10) UNSIGNED NOT NULL COMMENT '外键，具体内容id。如具体某一新闻，产品的id（或者某一分类的id）',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '标签/内容关联表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_tag_content
-- ----------------------------
INSERT INTO `cmf_tag_content` VALUES (5, 1, 6, 1);
INSERT INTO `cmf_tag_content` VALUES (7, 2, 7, 2);
INSERT INTO `cmf_tag_content` VALUES (9, 1, 6, 3);
INSERT INTO `cmf_tag_content` VALUES (10, 1, 7, 1);
INSERT INTO `cmf_tag_content` VALUES (11, 1, 6, 2);
INSERT INTO `cmf_tag_content` VALUES (12, 1, 7, 3);

-- ----------------------------
-- Table structure for cmf_theme
-- ----------------------------
DROP TABLE IF EXISTS `cmf_theme`;
CREATE TABLE `cmf_theme`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '安装时间',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后升级时间',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '模板状态,1:正在使用;0:未使用',
  `is_compiled` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否为已编译模板',
  `theme` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '主题目录名，用于主题的维一标识',
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '主题名称',
  `version` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '主题版本号',
  `demo_url` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '演示地址，带协议',
  `thumbnail` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '缩略图',
  `author` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '主题作者',
  `author_url` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '作者网站链接',
  `lang` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '支持语言',
  `keywords` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '主题关键字',
  `description` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '主题描述',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_theme
-- ----------------------------
INSERT INTO `cmf_theme` VALUES (1, 0, 1603790164, 0, 0, 'default', 'default', '1.0.0', 'soupai', '', 'soupai', 'soupai', 'zh-cn', 'soupai', 'soupai');

-- ----------------------------
-- Table structure for cmf_theme_file
-- ----------------------------
DROP TABLE IF EXISTS `cmf_theme_file`;
CREATE TABLE `cmf_theme_file`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_public` tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否公共的模板文件',
  `order_num` float NOT NULL DEFAULT 10000 COMMENT '排序',
  `theme` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '模板名称',
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '模板文件名',
  `action` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '操作',
  `file` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '模板文件，相对于模板根目录，如Portal/index.html',
  `description` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '模板文件描述',
  `more` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '模板更多配置,用户自己后台设置的',
  `config_more` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '模板更多配置,来源模板的配置文件',
  `draft_more` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '模板更多配置,用户临时保存的配置',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_theme_file
-- ----------------------------

-- ----------------------------
-- Table structure for cmf_third_party_user
-- ----------------------------
DROP TABLE IF EXISTS `cmf_third_party_user`;
CREATE TABLE `cmf_third_party_user`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0 COMMENT '本站用户id',
  `last_login_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后登录时间',
  `expire_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'access_token过期时间',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '绑定时间',
  `login_times` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '登录次数',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '状态;1:正常;0:禁用',
  `nickname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '用户昵称',
  `third_party` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '第三方唯一码',
  `app_id` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '第三方应用 id',
  `last_login_ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `access_token` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '第三方授权码',
  `openid` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '第三方用户id',
  `union_id` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '第三方用户多个产品中的惟一 id,(如:微信平台)',
  `more` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '扩展信息',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '第三方用户表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_third_party_user
-- ----------------------------

-- ----------------------------
-- Table structure for cmf_user
-- ----------------------------
DROP TABLE IF EXISTS `cmf_user`;
CREATE TABLE `cmf_user`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_type` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '用户类型;1:admin;2:会员',
  `sex` tinyint(2) NOT NULL DEFAULT 0 COMMENT '性别;0:保密,1:男,2:女',
  `birthday` int(11) NOT NULL DEFAULT 0 COMMENT '生日',
  `last_login_time` int(11) NOT NULL DEFAULT 0 COMMENT '最后登录时间',
  `score` int(11) NOT NULL DEFAULT 0 COMMENT '用户积分',
  `coin` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '金币',
  `balance` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '余额',
  `create_time` int(11) NOT NULL DEFAULT 0 COMMENT '注册时间',
  `user_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '用户状态;0:禁用,1:正常,2:未验证',
  `user_login` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `user_pass` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '登录密码;cmf_password加密',
  `user_nickname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户昵称',
  `user_email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '用户登录邮箱',
  `user_url` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '用户个人网址',
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '用户头像',
  `signature` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '个性签名',
  `last_login_ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `user_activation_key` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '激活码',
  `mobile` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '中国手机不带国家代码，国际手机号格式为：国家代码-手机号',
  `more` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '扩展属性',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_login`(`user_login`) USING BTREE,
  INDEX `user_nickname`(`user_nickname`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '用户表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_user
-- ----------------------------
INSERT INTO `cmf_user` VALUES (1, 1, 0, 0, 1604546179, 0, 0, 0.00, 1594082678, 1, 'admin', '###7069a9ab4b48b41bdb74c8db727782b9', 'admin', '516552667@qq.com', '', '', '', '127.0.0.1', '', '', NULL);
INSERT INTO `cmf_user` VALUES (2, 1, 0, 0, 1603436834, 0, 0, 0.00, 0, 1, 'spadmin', '###d29ae50ede24743872e5b4d717580e78', '', '111@qq.com', '', '', '', '::1', '', '', NULL);

-- ----------------------------
-- Table structure for cmf_user_action
-- ----------------------------
DROP TABLE IF EXISTS `cmf_user_action`;
CREATE TABLE `cmf_user_action`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `score` int(11) NOT NULL DEFAULT 0 COMMENT '更改积分，可以为负',
  `coin` int(11) NOT NULL DEFAULT 0 COMMENT '更改金币，可以为负',
  `reward_number` int(11) NOT NULL DEFAULT 0 COMMENT '奖励次数',
  `cycle_type` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '周期类型;0:不限;1:按天;2:按小时;3:永久',
  `cycle_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '周期时间值',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '用户操作名称',
  `action` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '用户操作名称',
  `app` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '操作所在应用名或插件名等',
  `url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '执行操作的url',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '用户操作表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_user_action
-- ----------------------------
INSERT INTO `cmf_user_action` VALUES (1, 1, 1, 1, 2, 1, '用户登录', 'login', 'user', '');

-- ----------------------------
-- Table structure for cmf_user_action_log
-- ----------------------------
DROP TABLE IF EXISTS `cmf_user_action_log`;
CREATE TABLE `cmf_user_action_log`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户id',
  `count` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '访问次数',
  `last_visit_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后访问时间',
  `object` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '访问对象的id,格式:不带前缀的表名+id;如posts1表示xx_posts表里id为1的记录',
  `action` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '操作名称;格式:应用名+控制器+操作名,也可自己定义格式只要不发生冲突且惟一;',
  `ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '用户ip',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_object_action`(`user_id`, `object`, `action`) USING BTREE,
  INDEX `user_object_action_ip`(`user_id`, `object`, `action`, `ip`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '访问记录表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_user_action_log
-- ----------------------------

-- ----------------------------
-- Table structure for cmf_user_balance_log
-- ----------------------------
DROP TABLE IF EXISTS `cmf_user_balance_log`;
CREATE TABLE `cmf_user_balance_log`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '用户 id',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `change` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '更改余额',
  `balance` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '更改后余额',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '描述',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '用户余额变更日志表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_user_balance_log
-- ----------------------------

-- ----------------------------
-- Table structure for cmf_user_favorite
-- ----------------------------
DROP TABLE IF EXISTS `cmf_user_favorite`;
CREATE TABLE `cmf_user_favorite`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户 id',
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '收藏内容的标题',
  `thumbnail` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '缩略图',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '收藏内容的原文地址，JSON格式',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '收藏内容的描述',
  `table_name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '收藏实体以前所在表,不带前缀',
  `object_id` int(10) UNSIGNED NULL DEFAULT 0 COMMENT '收藏内容原来的主键id',
  `create_time` int(10) UNSIGNED NULL DEFAULT 0 COMMENT '收藏时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `uid`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '用户收藏表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_user_favorite
-- ----------------------------

-- ----------------------------
-- Table structure for cmf_user_like
-- ----------------------------
DROP TABLE IF EXISTS `cmf_user_like`;
CREATE TABLE `cmf_user_like`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户 id',
  `object_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '内容原来的主键id',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `table_name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '内容以前所在表,不带前缀',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '内容的原文地址，不带域名',
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '内容的标题',
  `thumbnail` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '缩略图',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '内容的描述',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `uid`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '用户点赞表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_user_like
-- ----------------------------

-- ----------------------------
-- Table structure for cmf_user_login_attempt
-- ----------------------------
DROP TABLE IF EXISTS `cmf_user_login_attempt`;
CREATE TABLE `cmf_user_login_attempt`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `login_attempts` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '尝试次数',
  `attempt_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '尝试登录时间',
  `locked_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '锁定时间',
  `ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '用户 ip',
  `account` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '用户账号,手机号,邮箱或用户名',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '用户登录尝试表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of cmf_user_login_attempt
-- ----------------------------

-- ----------------------------
-- Table structure for cmf_user_nav
-- ----------------------------
DROP TABLE IF EXISTS `cmf_user_nav`;
CREATE TABLE `cmf_user_nav`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  `order_num` int(11) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `english_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_user_nav
-- ----------------------------
INSERT INTO `cmf_user_nav` VALUES (1, 0, NULL, 1, '首页', '', 'index/index/index');
INSERT INTO `cmf_user_nav` VALUES (2, 0, NULL, 2, '关于我们', '', 'index/about/index');
INSERT INTO `cmf_user_nav` VALUES (3, 0, NULL, 3, '产品展示', '', '/product.html');
INSERT INTO `cmf_user_nav` VALUES (4, 0, NULL, 4, '新闻动态', '', '/news.html');
INSERT INTO `cmf_user_nav` VALUES (5, 0, NULL, 5, '营销网络', '', '/net.html');
INSERT INTO `cmf_user_nav` VALUES (6, 0, NULL, 6, '联系方式', '', '/contact.html');
INSERT INTO `cmf_user_nav` VALUES (7, 0, NULL, 7, '留言反馈', '', '/message.html');
INSERT INTO `cmf_user_nav` VALUES (9, 3, NULL, 1, '工程机械', '', '/pro_category/12.html');
INSERT INTO `cmf_user_nav` VALUES (10, 3, NULL, 2, '印刷机械', '', '/pro_category/13.html');
INSERT INTO `cmf_user_nav` VALUES (11, 4, NULL, 0, '公司新闻', '', '');
INSERT INTO `cmf_user_nav` VALUES (12, 4, NULL, 0, '行业动态', '', '');

-- ----------------------------
-- Table structure for cmf_user_score_log
-- ----------------------------
DROP TABLE IF EXISTS `cmf_user_score_log`;
CREATE TABLE `cmf_user_score_log`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '用户 id',
  `create_time` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `action` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '用户操作名称',
  `score` int(11) NOT NULL DEFAULT 0 COMMENT '更改积分，可以为负',
  `coin` int(11) NOT NULL DEFAULT 0 COMMENT '更改金币，可以为负',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '用户操作积分等奖励日志表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_user_score_log
-- ----------------------------

-- ----------------------------
-- Table structure for cmf_user_token
-- ----------------------------
DROP TABLE IF EXISTS `cmf_user_token`;
CREATE TABLE `cmf_user_token`  (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '用户id',
  `expire_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT ' 过期时间',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT 'token',
  `device_type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '设备类型;mobile,android,iphone,ipad,web,pc,mac,wxapp',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '用户客户端登录 token 表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_user_token
-- ----------------------------
INSERT INTO `cmf_user_token` VALUES (1, 1, 1609634723, 1594082723, 'cb06f29f0f2aa185ec10078aac65a28843fdfafecf41bee0d3beda3e128bdb0a', 'web');
INSERT INTO `cmf_user_token` VALUES (2, 2, 1618987101, 1603435101, '133f97f70d8f78a4fde557ffba5c7402f652db89e7066bc705ce21d5aae972cb', 'web');

-- ----------------------------
-- Table structure for cmf_verification_code
-- ----------------------------
DROP TABLE IF EXISTS `cmf_verification_code`;
CREATE TABLE `cmf_verification_code`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '表id',
  `count` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '当天已经发送成功的次数',
  `send_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后发送成功时间',
  `expire_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '验证码过期时间',
  `code` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '最后发送成功的验证码',
  `account` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '手机号或者邮箱',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '手机邮箱数字验证码表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_verification_code
-- ----------------------------

-- ----------------------------
-- Table structure for cmf_video
-- ----------------------------
DROP TABLE IF EXISTS `cmf_video`;
CREATE TABLE `cmf_video`  (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `cid` int(12) NULL DEFAULT NULL,
  `lang` int(1) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `order_num` int(12) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  `create_time` int(12) NULL DEFAULT NULL,
  `show_time` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '发布时间，可修改',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmf_video
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
