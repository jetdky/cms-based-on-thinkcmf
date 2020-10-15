/*
 Navicat MySQL Data Transfer

 Source Server         : msyql
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : 127.0.0.1:3306
 Source Schema         : cms

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 15/10/2020 15:15:57
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '全站配置表' ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of cmf_option
-- ----------------------------
INSERT INTO `cmf_option` VALUES (1, 1, 'site_info', '{\"site_name\":\"\\u4e0a\\u6d77\\u6c11\\u8054\\u673a\\u68b0\\u5bc6\\u5c01\\u4ef6\\u6709\\u9650\\u516c\\u53f8\",\"site_seo_title\":\"ThinkCMF\\u5185\\u5bb9\\u7ba1\\u7406\\u6846\\u67b6\",\"site_seo_keywords\":\"ThinkCMF,php,\\u5185\\u5bb9\\u7ba1\\u7406\\u6846\\u67b6,cmf,cms,\\u7b80\\u7ea6\\u98ce, simplewind,framework\",\"site_seo_description\":\"ThinkCMF\\u662f\\u7b80\\u7ea6\\u98ce\\u7f51\\u7edc\\u79d1\\u6280\\u53d1\\u5e03\\u7684\\u4e00\\u6b3e\\u7528\\u4e8e\\u5feb\\u901f\\u5f00\\u53d1\\u7684\\u5185\\u5bb9\\u7ba1\\u7406\\u6846\\u67b6\",\"site_icp\":\"00001\",\"site_gwa\":\"\\u6d59ICP\\u5907\",\"site_admin_email\":\"\",\"site_analytics\":\"\",\"logo\":\"admin\\/20200827\\/913c49121a329e1774dc62075683b3ff.png\",\"phone\":\"0557-65542448\",\"fax\":\"0551-65542448\",\"mobile\":\"18888888888\",\"email\":\"1@qq.com\",\"qq\":\"888888\",\"address_cn\":\"\\u6d59\\u6c5f\\u5b81\\u6ce2\",\"address_en\":\"zhejiang ningbo\",\"lng\":\"121.634754\",\"lat\":\"29.809996\",\"WeChat\":\"admin\\/20201014\\/57bb5534d2afc0cb5e84e86eda3151d6.jpg\",\"site_name_en\":\"Shanghai Minlian Mechanical seals Co. LTd\",\"phoneweb\":\"admin\\/20201014\\/57bb5534d2afc0cb5e84e86eda3151d6.jpg\"}');
INSERT INTO `cmf_option` VALUES (2, 1, 'admin_dashboard_widgets', '[{\"name\":\"CmfHub\",\"is_system\":1},{\"name\":\"Contributors\",\"is_system\":1},{\"name\":\"CmfDocuments\",\"is_system\":1},{\"name\":\"MainContributors\",\"is_system\":1},{\"name\":\"Custom1\",\"is_system\":1},{\"name\":\"Custom2\",\"is_system\":1},{\"name\":\"Custom3\",\"is_system\":1},{\"name\":\"Custom4\",\"is_system\":1},{\"name\":\"Custom5\",\"is_system\":1}]');
INSERT INTO `cmf_option` VALUES (3, 1, 'upload_setting', '{\"0\":\"{\\\"max_files\\\":\\\"20\\\",\\\"chunk_size\\\":\\\"512\\\",\\\"file_types\\\":{\\\"image\\\":{\\\"upload_max_filesize\\\":\\\"10240\\\",\\\"extensions\\\":\\\"jpg,jpeg,png,gif,bmp4\\\"},\\\"video\\\":{\\\"upload_max_filesize\\\":\\\"102400\\\",\\\"extensions\\\":\\\"mp4,avi,wmv,rm,rmvb,mkv\\\"},\\\"audio\\\":{\\\"upload_max_filesize\\\":\\\"10240\\\",\\\"extensions\\\":\\\"mp3,wma,wav\\\"},\\\"file\\\":{\\\"upload_max_filesize\\\":\\\"10240\\\",\\\"extensions\\\":\\\"txt,pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar\\\"}}}\",\"max_files\":\"20\",\"chunk_size\":\"512\",\"file_types\":{\"image\":{\"upload_max_filesize\":\"102400\",\"extensions\":\"jpg,jpeg,png,gif,bmp4\"},\"video\":{\"upload_max_filesize\":\"102400\",\"extensions\":\"mp4,avi,wmv,rm,rmvb,mkv\"},\"audio\":{\"upload_max_filesize\":\"10240\",\"extensions\":\"mp3,wma,wav\"},\"file\":{\"upload_max_filesize\":\"102400\",\"extensions\":\"txt,pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar\"}}}');
INSERT INTO `cmf_option` VALUES (4, 1, 'admin_settings', '{\"admin_password\":\"\",\"admin_theme\":\"admin_simpleboot3\",\"admin_style\":\"orangeadmin\"}');
INSERT INTO `cmf_option` VALUES (5, 1, 'cmf_settings', '{\"0\":\"{\\\"banned_usernames\\\":\\\"\\\"}\",\"banned_usernames\":\"\"}');

SET FOREIGN_KEY_CHECKS = 1;
