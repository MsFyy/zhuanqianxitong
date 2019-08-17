/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : localhost:3306
 Source Schema         : tp5

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 22/12/2018 15:25:18
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `code` int(255) NULL DEFAULT NULL,
  `last_login_time` int(255) NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mobile` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `paixu` int(255) NULL DEFAULT NULL,
  `zhuangtai` tinyint(255) NULL DEFAULT NULL,
  `create_time` int(255) NULL DEFAULT NULL,
  `update_time` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'admin', '4d42a7dc3d324356de9632f7af84ccf2', 9686, NULL, 'zidong@126.com', '1', 1, 1, NULL, 1539485487);
INSERT INTO `admin` VALUES (4, 'admin11', 'f39b0dc5b0cf65a6fe6c880ff98156a2', 537, NULL, '', '', 0, 1, 1538982234, 1539336759);
INSERT INTO `admin` VALUES (5, '11', '2fdddc426480d46ce18affae5e455c82', 7364, NULL, '', '', 0, -1, 1538982288, 1538984889);
INSERT INTO `admin` VALUES (6, 'd', '4ca987e02bbbf558114f8c0633e2c7ac', 4387, NULL, '', '', 0, -1, 1538982861, 1538984894);
INSERT INTO `admin` VALUES (7, '1', '6be2c7d9b4beb7e867114e4d9d25bfed', 9206, NULL, '', '', 0, -1, 1538982877, 1538984577);
INSERT INTO `admin` VALUES (8, 'admin000', '11', 9782, NULL, '1', '', 0, 1, 1538983446, 1538984750);
INSERT INTO `admin` VALUES (9, 'admin881', '14', 2039, NULL, '1', '', 0, 1, 1538983752, 1538984529);
INSERT INTO `admin` VALUES (10, 'dd', '053b47ac39ef2ea08d354ee54baadabb', 6360, NULL, '', '', 0, -1, 1539336263, 1539761643);

-- ----------------------------
-- Table structure for daohang
-- ----------------------------
DROP TABLE IF EXISTS `daohang`;
CREATE TABLE `daohang`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `lianjie` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `zhuangtai` tinyint(255) NULL DEFAULT NULL,
  `create_time` int(255) NULL DEFAULT NULL,
  `update_time` int(255) NULL DEFAULT NULL,
  `paixu` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of daohang
-- ----------------------------
INSERT INTO `daohang` VALUES (1, '首页', NULL, 1, NULL, 1538294859, 0);
INSERT INTO `daohang` VALUES (2, '精彩案例', '1', 1, NULL, NULL, 1);
INSERT INTO `daohang` VALUES (3, '主页3', '1', 1, 1538292281, 1538295224, 1);
INSERT INTO `daohang` VALUES (4, '栏目12', '1', 1, 1538292424, 1538295345, 2);

-- ----------------------------
-- Table structure for fenxiang
-- ----------------------------
DROP TABLE IF EXISTS `fenxiang`;
CREATE TABLE `fenxiang`  (
  `id` int(20) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '内容',
  `xueyuanleixing` int(255) NULL DEFAULT NULL COMMENT '学员类型',
  `xueyuanid` int(255) NULL DEFAULT NULL COMMENT '学员id',
  `create_time` int(20) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` int(20) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 64 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fenxiang
-- ----------------------------
INSERT INTO `fenxiang` VALUES (49, '免费分享修改：我是如何独自一人，通过网络， 4个月成交2000多名客户的！ 我从事网络营销工作很多年 最终 研发了一套网络营销方法 5年时间不到 仅仅我一个人 累计成交了2万多名客户 净赚500多万 并且 我还创造了&mdash;&mdash; 4个月成交2000多名客户的纪录 我将我的网络营销方法 全部记录整理在一起了 取名《赚钱不难》 ', 3, 1, 1544252508, 1545459652);

-- ----------------------------
-- Table structure for gaofei
-- ----------------------------
DROP TABLE IF EXISTS `gaofei`;
CREATE TABLE `gaofei`  (
  `id` int(20) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `dingdanhao` bigint(255) NULL DEFAULT NULL COMMENT '订单号',
  `wenzhangid` int(255) NULL DEFAULT NULL COMMENT '文章id',
  `shouruzheid` int(255) NULL DEFAULT NULL COMMENT '收入者id',
  `shouruzheleixing` int(255) NULL DEFAULT NULL COMMENT '收入者类型',
  `xueyuanid` int(255) NULL DEFAULT NULL COMMENT '学员id',
  `xueyuanleixing` int(20) NULL DEFAULT NULL COMMENT '学员类型',
  `jiesuanzhuangtai` int(20) NULL DEFAULT 0 COMMENT '结算状态:0未结算；1结算中；2已付款；3结算异常',
  `shouru` decimal(20, 2) NULL DEFAULT 0.00 COMMENT '收入',
  `beizhu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  `zhuangtai` int(10) NULL DEFAULT 1 COMMENT '显示状态:0不显示，1正常显示',
  `create_time` int(255) NULL DEFAULT NULL COMMENT '创建日期',
  `update_time` int(255) NULL DEFAULT NULL COMMENT '结算日期',
  `jiesuandanhao` bigint(255) NULL DEFAULT NULL COMMENT '结算单号',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 322 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of gaofei
-- ----------------------------
INSERT INTO `gaofei` VALUES (316, 356533, 50, 1, 3, 18, 1, 2, 8.00, NULL, 1, 1541238625, 1541316932, 2954011544942464);
INSERT INTO `gaofei` VALUES (317, 356533, 49, 1, 3, 18, 1, 2, 8.00, NULL, 1, 1541238625, 1541316932, 2954011544942464);
INSERT INTO `gaofei` VALUES (318, 356533, 51, 1, 3, 18, 1, 2, 8.00, NULL, 1, 1541238625, 1541316932, 2954011544942464);
INSERT INTO `gaofei` VALUES (319, 356533, 50, 1, 3, 18, 1, 2, 8.00, NULL, 1, 1541238625, 1541316932, 2954011544942464);
INSERT INTO `gaofei` VALUES (320, 145108451541238629, 50, 4, 3, 18, 1, 2, 8.00, NULL, 1, 1541238625, 1541316932, 8581401544927824);
INSERT INTO `gaofei` VALUES (321, 145108451541238629, 50, 4, 3, 18, 1, 2, 8.00, NULL, 1, 1541238625, 1541316932, 8581401544927824);

-- ----------------------------
-- Table structure for gongneng
-- ----------------------------
DROP TABLE IF EXISTS `gongneng`;
CREATE TABLE `gongneng`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `parent_id` int(255) NULL DEFAULT NULL,
  `paixu` int(255) NULL DEFAULT NULL,
  `lianjie` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `beizhu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `iconb` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `icons` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `zhuangtai` int(255) NULL DEFAULT NULL,
  `create_time` int(255) NULL DEFAULT NULL,
  `update_time` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 60 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of gongneng
-- ----------------------------
INSERT INTO `gongneng` VALUES (27, '系统管理员', 0, 3, '1', '1', 'fa', 'fa-cog ', 1, 1538706959, 1540714774);
INSERT INTO `gongneng` VALUES (26, '幻灯片添加', 24, 2, 'Huandengpian/huandengpianadd', '', '', '', 1, 1538296844, 1538296962);
INSERT INTO `gongneng` VALUES (25, '幻灯片列表', 24, 1, 'Huandengpian/huandengpianlist', '', '', '', 1, 1538296810, 1538296950);
INSERT INTO `gongneng` VALUES (24, '幻灯片管理', 0, 2, 'Huandengpain/huandengpianlist', '', 'glyphicon', 'glyphicon-picture', 1, 1538296767, 1538296767);
INSERT INTO `gongneng` VALUES (23, '撒旦法阿萨德撒', 0, 1, '1', '1', '1', '1', -1, 1538296663, 1538296670);
INSERT INTO `gongneng` VALUES (22, '增加导航', 20, 1, 'Daohang/daohangadd', '1', '1', '1', 1, 1538271816, 1538292932);
INSERT INTO `gongneng` VALUES (20, '站点导航', 0, 1, '1', '1', 'fa', 'fa-credit-card', 1, 1538271746, 1538271969);
INSERT INTO `gongneng` VALUES (21, '导航类表', 20, 1, 'Daohang/daohanglist', '1', '1', '1', 1, 1538271790, 1538292945);
INSERT INTO `gongneng` VALUES (28, '管理员列表', 27, 1, 'admin/adminlist', '1', '', '', 1, 1538707014, 1538707014);
INSERT INTO `gongneng` VALUES (29, '添加管理员', 27, 2, 'admin/adminadd', '', '', '', 1, 1538707048, 1538707048);
INSERT INTO `gongneng` VALUES (30, '个人信息', 0, 4, '1', '', 'glyphicon', 'glyphicon-user', 1, 1538987443, 1538987443);
INSERT INTO `gongneng` VALUES (31, '基本信息', 30, 0, 'admin/gerenindex', '', '', '', 1, 1538987494, 1538987494);
INSERT INTO `gongneng` VALUES (32, '信息修改', 30, 1, 'admin/gerenxiugai', '', '', '', 1, 1538988750, 1539420151);
INSERT INTO `gongneng` VALUES (33, '用户名修改', 30, 0, 'admin/yonghumingxiugai', '', '', '', 1, 1539420588, 1539420789);
INSERT INTO `gongneng` VALUES (34, '密码修改', 30, 0, 'admin/mimaxiugai', '', '', '', 1, 1539421085, 1539421085);
INSERT INTO `gongneng` VALUES (35, '栏目管理', 0, 5, '1', '1', 'glyphicon', 'glyphicon-list ', 1, 1539833404, 1539833404);
INSERT INTO `gongneng` VALUES (36, '栏目列表', 35, 1, 'Lanmu/lanmulist', '1', '', '', 1, 1539833461, 1539833461);
INSERT INTO `gongneng` VALUES (37, '添加栏目', 35, 2, 'Lanmu/lanmuadd', '1', '', '', 1, 1539834049, 1544263874);
INSERT INTO `gongneng` VALUES (38, '内容管理', 0, 7, '1', '1', 'glyphicon', 'glyphicon-book', 1, 1539931994, 1539931994);
INSERT INTO `gongneng` VALUES (39, '管理内容', 38, 1, 'neirong/neironglist', '', '', '', 1, 1539932054, 1544264034);
INSERT INTO `gongneng` VALUES (40, '添加内容', 38, 2, 'neirong/neirongadd', '', '', '', -1, 1539932093, 1544263974);
INSERT INTO `gongneng` VALUES (43, '学员管理', 0, 9, '1', '1', 'fa', ' fa-users ', 1, 1540714681, 1541236127);
INSERT INTO `gongneng` VALUES (49, '微信学员', 43, 0, 'xueyuan/weixinxueyuan', '', '', '', 1, 1544516533, 1544516573);
INSERT INTO `gongneng` VALUES (48, '注册学员', 43, 0, 'xueyuan/zhucexueyuan', '', '', '', 1, 1544516282, 1544516559);
INSERT INTO `gongneng` VALUES (50, 'QQ学员', 43, 0, 'xueyuan/qqxueyuan', '', '', '', 1, 1544516623, 1544516623);
INSERT INTO `gongneng` VALUES (51, '结算中心', 0, 50, '1', '', 'glyphicon', 'glyphicon glyphicon-usd', 1, 1544661155, 1544661155);
INSERT INTO `gongneng` VALUES (52, '稿费结算', 51, 0, 'jiesuanzhongxin/gaofeijiesuan', '', '', '', 1, 1544661232, 1544661232);
INSERT INTO `gongneng` VALUES (53, '推广结算', 51, 5, 'jiesuanzhongxin/tuiguangjiesuan', '', '', '', 1, 1544661278, 1544772493);
INSERT INTO `gongneng` VALUES (54, '招聘结算', 51, 9, 'jiesuanzhongxin/zhaopinjiesuan', '', '', '', 1, 1544661323, 1544929571);
INSERT INTO `gongneng` VALUES (55, '稿费记录', 51, 1, 'jiesuanzhongxin/gaofeijiesuanjilu', '', '', '', 1, 1544772442, 1544777662);
INSERT INTO `gongneng` VALUES (56, '推广费记录', 51, 6, 'jiesuanzhongxin/tuiguangjiesuanjilu', '', '', '', 1, 1544772447, 1544777921);
INSERT INTO `gongneng` VALUES (58, '招聘费记录', 51, 11, 'jiesuanzhongxin/zhaopinjiesuanjilu', '', '', '', 1, 1544773037, 1544942407);
INSERT INTO `gongneng` VALUES (57, '付款账单', 51, 15, 'jiesuanzhongxin/fukuanzhangdan', '', '', '', 1, 1544772825, 1544775489);

-- ----------------------------
-- Table structure for huandengpian
-- ----------------------------
DROP TABLE IF EXISTS `huandengpian`;
CREATE TABLE `huandengpian`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `lianjie` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `zhuangtai` tinyint(255) NULL DEFAULT NULL,
  `create_time` int(255) NULL DEFAULT NULL,
  `update_time` int(255) NULL DEFAULT NULL,
  `paixu` int(255) NULL DEFAULT NULL,
  `suoluetu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huandengpian
-- ----------------------------
INSERT INTO `huandengpian` VALUES (12, '测试测试7744', '1', 1, 1538557500, 1538557999, 1, '/public/uploads/flash/1538557494.png');
INSERT INTO `huandengpian` VALUES (13, '订单', '1', 1, 1540024127, 1540024127, 1, '/public/uploads/flash/1540024122.png');

-- ----------------------------
-- Table structure for jiesuan
-- ----------------------------
DROP TABLE IF EXISTS `jiesuan`;
CREATE TABLE `jiesuan`  (
  `id` int(20) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `jiesuandanhao` bigint(255) NULL DEFAULT NULL COMMENT '订单号',
  `shouruzheid` int(255) NULL DEFAULT NULL COMMENT '收入者id',
  `shouruzheleixing` int(255) NULL DEFAULT NULL COMMENT '收入者类型',
  `fukuanzhuangtai` int(20) NULL DEFAULT 0 COMMENT '付款状态：0未付款；1已付款',
  `shouruleixing` int(20) NULL DEFAULT NULL COMMENT '收入类型：1稿费；2推广；3招商',
  `shouru` decimal(20, 2) NULL DEFAULT 0.00 COMMENT '收入',
  `create_time` int(255) NULL DEFAULT NULL COMMENT '创建日期',
  `update_time` int(255) NULL DEFAULT NULL COMMENT '结算日期',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 345 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of jiesuan
-- ----------------------------
INSERT INTO `jiesuan` VALUES (343, 3987331544929869, 1, 3, 1, 3, 8.00, 1544929869, 1544931556);
INSERT INTO `jiesuan` VALUES (342, 6410681544928135, 1, 3, 1, 2, 16.00, 1544928135, 1544931558);
INSERT INTO `jiesuan` VALUES (341, 8581401544927824, 4, 3, 1, 1, 16.00, 1544927824, 1544931560);
INSERT INTO `jiesuan` VALUES (344, 2954011544942464, 1, 3, 1, 1, 32.00, 1544942464, 1544942472);

-- ----------------------------
-- Table structure for lanmu
-- ----------------------------
DROP TABLE IF EXISTS `lanmu`;
CREATE TABLE `lanmu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `parent_id` int(255) NULL DEFAULT NULL,
  `paixu` int(255) NULL DEFAULT NULL,
  `lianjie` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `beizhu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `zhuangtai` int(255) NULL DEFAULT NULL,
  `create_time` int(255) NULL DEFAULT NULL,
  `update_time` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 36 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lanmu
-- ----------------------------
INSERT INTO `lanmu` VALUES (27, '经典营销', 0, 3, '1', '1', 1, 1538706959, 1544250979);
INSERT INTO `lanmu` VALUES (26, '励志故事', 24, 2, 'Huandengpian/huandengpianadd', '', 1, 1538296844, 1544251037);
INSERT INTO `lanmu` VALUES (25, '成功故事', 24, 1, 'Huandengpian/huandengpianlist', '', 1, 1538296810, 1544251026);
INSERT INTO `lanmu` VALUES (24, '成功励志', 0, 2, 'Huandengpain/huandengpianlist', '', 1, 1538296767, 1544250955);
INSERT INTO `lanmu` VALUES (23, '撒旦法阿萨德撒', 0, 1, '1', '1', -1, 1538296663, 1538296670);
INSERT INTO `lanmu` VALUES (22, '防骗秘籍', 20, 1, 'Daohang/daohangadd', '1', 1, 1538271816, 1544234930);
INSERT INTO `lanmu` VALUES (20, '行走江湖', 0, 1, '1', '1', 1, 1538271746, 1544234991);
INSERT INTO `lanmu` VALUES (21, '江湖知识', 20, 1, 'Daohang/daohanglist', '1', 1, 1538271790, 1544250908);
INSERT INTO `lanmu` VALUES (28, '经典案例', 27, 1, 'admin/adminlist', '1', 1, 1538707014, 1544251058);
INSERT INTO `lanmu` VALUES (29, '营销策略', 27, 2, 'admin/adminadd', '', 1, 1538707048, 1544251071);
INSERT INTO `lanmu` VALUES (30, '赚钱项目', 0, 4, '1', '', 1, 1538987443, 1544251002);
INSERT INTO `lanmu` VALUES (31, '小本赚钱 ', 30, 0, 'admin/gerenindex', '', 1, 1538987494, 1544251107);
INSERT INTO `lanmu` VALUES (32, '信息修改', 30, 1, 'admin/gerenxiugai', '', -1, 1538988750, 1539854075);
INSERT INTO `lanmu` VALUES (33, '赚钱韬略', 30, 0, 'admin/yonghumingxiugai', '', 1, 1539420588, 1544251134);
INSERT INTO `lanmu` VALUES (34, '密码修改', 30, 0, 'admin/mimaxiugai', '', -1, 1539421085, 1539854084);
INSERT INTO `lanmu` VALUES (35, '测试', 20, 1, NULL, '', -1, 1539834400, 1544250913);

-- ----------------------------
-- Table structure for neirong
-- ----------------------------
DROP TABLE IF EXISTS `neirong`;
CREATE TABLE `neirong`  (
  `id` int(20) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '标题',
  `leibie` int(20) NULL DEFAULT NULL COMMENT '一级类别',
  `leibieer` int(20) NULL DEFAULT NULL COMMENT '二级类别',
  `paixu` int(20) NULL DEFAULT 0 COMMENT '排序',
  `gaishu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '内容简介',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '内容',
  `jiage` decimal(30, 2) NULL DEFAULT 0.00 COMMENT '价格',
  `liulantongji` int(255) NULL DEFAULT 0 COMMENT '浏览统计',
  `zhuangtai` int(10) NULL DEFAULT 0 COMMENT '显示状态：-2未通过审核；-1删除；0审核中；1通过审核；2推荐；3置顶',
  `zuozheleixing` int(255) NULL DEFAULT NULL COMMENT '作者类型',
  `zuozheid` int(255) NULL DEFAULT NULL COMMENT '作者id',
  `create_time` int(20) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` int(20) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 64 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of neirong
-- ----------------------------
INSERT INTO `neirong` VALUES (49, '防骗密集', 20, 22, 2, '测试测试测试测试测试测试测试测试测试测试测试测试测试', '&lt;p&gt;测试测试测试测试测试测试测试测试测试测试测试测试测试&amp;nbsp;&lt;/p&gt;', 2001.00, 0, 0, 3, 1, 1544252508, 1545378589);
INSERT INTO `neirong` VALUES (50, '秘籍2212', 20, 22, 201, '秘籍2212', '<p>&nbsp; &nbsp; &nbsp; 秘籍2212</p>', 40.00, 0, 2, 3, 1, 1544252572, 1544491899);
INSERT INTO `neirong` VALUES (51, '测试', 20, 22, 210, '1', '<p>&nbsp; &nbsp; &nbsp;&nbsp; 111 <br/></p>', 5.00, 0, -1, 3, 1, 1544406619, 1545378600);
INSERT INTO `neirong` VALUES (52, '测试', 20, 22, 0, '订单的', NULL, 0.00, 0, -1, 3, 1, 1545288616, 1545378605);
INSERT INTO `neirong` VALUES (63, '阿萨德', 20, 22, 0, NULL, '&lt;p&gt;\r\n						&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;内容\r\n						 &amp;nbsp; &amp;nbsp;&lt;/p&gt;', 0.00, 0, 0, 3, 1, 1545376565, 1545376565);

-- ----------------------------
-- Table structure for neirongmulu
-- ----------------------------
DROP TABLE IF EXISTS `neirongmulu`;
CREATE TABLE `neirongmulu`  (
  `id` int(20) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '标题',
  `wenzhangid` int(20) NULL DEFAULT NULL COMMENT '文章id',
  `paixu` int(20) NULL DEFAULT 0 COMMENT '排序',
  `gaishu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '内容简介',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '内容',
  `liulantongji` int(255) NULL DEFAULT 0 COMMENT '浏览统计',
  `zhuangtai` int(10) NULL DEFAULT 1 COMMENT '显示状态：-2未通过审核；-1删除；0审核中；1通过审核；2推荐；3置顶',
  `create_time` int(20) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` int(20) NULL DEFAULT NULL COMMENT '更新时间',
  `parent_id` int(11) NULL DEFAULT 0 COMMENT '父路径',
  `shikan` int(255) NULL DEFAULT 0 COMMENT '是否试看：1是；0否',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 68 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of neirongmulu
-- ----------------------------
INSERT INTO `neirongmulu` VALUES (49, '第一章', 49, 1, '测试测试测试测试测试测试测试测试测试测试测试测试测试', '<p>测试测试测试测试测试测试测试测试测试测试测试测试测试&nbsp;</p>', 0, 1, 1544252508, 1545272959, 0, NULL);
INSERT INTO `neirongmulu` VALUES (50, '第一章第一节', 49, 1, '秘籍2212', '<p>&nbsp; &nbsp; &nbsp; 秘籍2212</p>', 0, 1, 1544252572, 1545272974, 49, NULL);
INSERT INTO `neirongmulu` VALUES (51, '第一章第二节', 49, 2, '1', '<p>&nbsp; &nbsp; &nbsp;&nbsp; 111 <br/></p>', 0, 1, 1544406619, 1545272977, 49, NULL);
INSERT INTO `neirongmulu` VALUES (52, '第二章', 49, 2, '测试测试测试测试测试测试测试测试测试测试测试测试测试', '<p>测试测试测试测试测试测试测试测试测试测试测试测试测试&nbsp;</p>', 0, 1, 1544252508, 1545272963, 0, NULL);
INSERT INTO `neirongmulu` VALUES (53, '第二章第一节', 49, 1, '秘籍2212', '<p>&nbsp; &nbsp; &nbsp; 秘籍2212</p>', 0, 1, 1544252572, 1545271209, 52, NULL);
INSERT INTO `neirongmulu` VALUES (58, '网易', 52, 0, '网易课堂', NULL, 0, 1, NULL, NULL, 0, 0);
INSERT INTO `neirongmulu` VALUES (56, '电饭锅山东', 49, 3, '', NULL, 0, 1, NULL, 1545272946, 0, 0);
INSERT INTO `neirongmulu` VALUES (59, '腾讯课堂', 52, 0, '阿萨德', NULL, 0, 1, NULL, NULL, 0, 0);
INSERT INTO `neirongmulu` VALUES (60, '但是', 52, 1, '1', '<p>111</p>', 0, 1, 1545292794, 1545292794, 58, 0);
INSERT INTO `neirongmulu` VALUES (61, '第一章', 63, 100, '大事发生的', NULL, 0, 1, NULL, 1545398700, 0, 0);
INSERT INTO `neirongmulu` VALUES (62, '第一节', 63, 10, '阿萨德', '&lt;p&gt;&amp;nbsp; &amp;nbsp;&amp;nbsp; 收到&amp;nbsp; &amp;nbsp; &amp;nbsp;&amp;nbsp; &lt;br/&gt;&lt;/p&gt;', 0, 1, 1545381096, 1545398739, 61, 0);
INSERT INTO `neirongmulu` VALUES (63, '第二章', 63, 50, '收到', NULL, 0, 1, NULL, 1545398716, 0, 0);
INSERT INTO `neirongmulu` VALUES (64, '第二章第一节', 63, 1, '水电费', '&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;这里写你的初始化内容fff\r\n &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/p&gt;', 0, 1, 1545381129, 1545381129, 63, 0);
INSERT INTO `neirongmulu` VALUES (65, '阿萨德', 63, 6, '阿萨德', '&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;这里写你的初始化内容fff\r\n &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/p&gt;', 0, 1, 1545396504, 1545398630, 61, 0);
INSERT INTO `neirongmulu` VALUES (66, '第三章', 63, 30, '', NULL, 0, 1, NULL, 1545398722, 0, 0);
INSERT INTO `neirongmulu` VALUES (67, '第四章', 63, 20, '', NULL, 0, 1, NULL, 1545398728, 0, 0);

-- ----------------------------
-- Table structure for qqxueyuan
-- ----------------------------
DROP TABLE IF EXISTS `qqxueyuan`;
CREATE TABLE `qqxueyuan`  (
  `id` int(255) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `openid` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'QQ用户的标识',
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'QQ学员昵称',
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'QQ学员头像',
  `leixing` int(255) NULL DEFAULT 2 COMMENT '学员类型：1微信学员；2qq学员；3注册学员',
  `zhuangtai` tinyint(255) NULL DEFAULT NULL COMMENT '状态：1正常；-1拉黑',
  `tuijianxueyuanid` int(255) NULL DEFAULT NULL COMMENT '推荐学员的id',
  `tuijianxueyuanleixing` int(255) NULL DEFAULT NULL COMMENT '推荐学员的类型',
  `mobile` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '手机',
  `qqlianxi` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'qq联系',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '邮箱',
  `yinhang` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '银行',
  `kaihuhang` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '开户行',
  `yinhangzhanghao` int(255) NULL DEFAULT NULL COMMENT '银行账号',
  `xingming` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '真实姓名',
  `create_time` int(255) NULL DEFAULT NULL COMMENT '注册时间',
  `update_time` int(255) NULL DEFAULT NULL COMMENT '最后登录日期',
  `denglucishu` int(255) NULL DEFAULT 0 COMMENT '登陆次数',
  `shifougonggaozhe` int(255) NULL DEFAULT NULL COMMENT '是否供稿者',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qqxueyuan
-- ----------------------------
INSERT INTO `qqxueyuan` VALUES (18, 'oYfsh1aYlBPkpg92eOWqYiZOTopk', '天道酬勤qq', 'http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83erOGe6UCn0hUibW4xiaE2sOicnrDlg1TKFtfpcov9k5YoDf3BqhNfj9ZpVpJUlvQwfU2kouGJjIxC91g/132', 2, 1, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1543564271, 1543564271, 0, NULL);

-- ----------------------------
-- Table structure for tuiguangyongjin
-- ----------------------------
DROP TABLE IF EXISTS `tuiguangyongjin`;
CREATE TABLE `tuiguangyongjin`  (
  `id` int(20) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `dingdanhao` bigint(255) NULL DEFAULT NULL COMMENT '订单号',
  `wenzhangid` int(255) NULL DEFAULT NULL COMMENT '文章id',
  `shouruzheid` int(255) NULL DEFAULT NULL COMMENT '收入者id',
  `shouruzheleixing` int(255) NULL DEFAULT NULL COMMENT '收入者类型',
  `xueyuanid` int(255) NULL DEFAULT NULL COMMENT '学员id',
  `xueyuanleixing` int(20) NULL DEFAULT NULL COMMENT '学员类型',
  `jiesuanzhuangtai` int(20) NULL DEFAULT NULL COMMENT '结算状态:0未结算；1结算中；2已付款；3结算异常',
  `shouru` decimal(20, 2) NULL DEFAULT 0.00 COMMENT '收入',
  `beizhu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  `zhuangtai` int(10) NULL DEFAULT 1 COMMENT '显示状态',
  `create_time` int(255) NULL DEFAULT NULL COMMENT '创建日期',
  `update_time` int(255) NULL DEFAULT NULL COMMENT '结算日期',
  `jiesuandanhao` bigint(255) NULL DEFAULT NULL COMMENT '结算单号',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 319 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tuiguangyongjin
-- ----------------------------
INSERT INTO `tuiguangyongjin` VALUES (316, 145108451541238625, 50, 1, 3, 5, 1, 2, 8.00, NULL, 1, 1541238625, 1541316932, 6410681544928135);
INSERT INTO `tuiguangyongjin` VALUES (317, 145108451541238625, 50, 1, 3, 5, 1, 2, 8.00, NULL, 1, 1541238625, 1541316932, 6410681544928135);
INSERT INTO `tuiguangyongjin` VALUES (318, 145108451541238625, 50, 5, 3, 5, 1, 0, 8.00, NULL, 1, 1541238625, 1541316932, 1848511544778129);

-- ----------------------------
-- Table structure for weixinxueyuan
-- ----------------------------
DROP TABLE IF EXISTS `weixinxueyuan`;
CREATE TABLE `weixinxueyuan`  (
  `id` int(255) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `uid` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '微信用户统一标识',
  `openid` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '微信标识',
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '微信学员昵称',
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '微信学员头像',
  `leixing` int(255) NULL DEFAULT 2 COMMENT '学员类型：1微信学员；2qq学员；3注册学员',
  `zhuangtai` tinyint(255) NULL DEFAULT NULL COMMENT '状态：1正常；-1拉黑',
  `tuijianxueyuanid` int(255) NULL DEFAULT NULL COMMENT '推荐学员的id',
  `tuijianxueyuanleixing` int(255) NULL DEFAULT NULL COMMENT '推荐学员的类型',
  `mobile` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '手机',
  `qqlianxi` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'QQ联系方式',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '邮箱',
  `yinhang` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '银行',
  `kaihuhang` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '开户行',
  `yinhangzhanghao` int(255) NULL DEFAULT NULL COMMENT '银行账号',
  `xingming` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '真实姓名',
  `create_time` int(255) NULL DEFAULT NULL COMMENT '注册时间',
  `update_time` int(255) NULL DEFAULT NULL COMMENT '最后登录日期',
  `denglucishu` int(255) NULL DEFAULT 0 COMMENT '登录次数',
  `shoufougonggaozhe` int(255) NULL DEFAULT 0 COMMENT '是否是供稿者：1是，0否',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of weixinxueyuan
-- ----------------------------
INSERT INTO `weixinxueyuan` VALUES (18, 'oU7CB1TyNkQYGLFvg8PKjCXMkEU0', 'oYfsh1aYlBPkpg92eOWqYiZOTopk', '天道酬勤', 'http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83erOGe6UCn0hUibW4xiaE2sOicnrDlg1TKFtfpcov9k5YoDf3BqhNfj9ZpVpJUlvQwfU2kouGJjIxC91g/132', 1, 1, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1543564271, 1544664111, 0, 0);

-- ----------------------------
-- Table structure for xitong
-- ----------------------------
DROP TABLE IF EXISTS `xitong`;
CREATE TABLE `xitong`  (
  `id` int(255) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '系统名称',
  `dizhi` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '地址',
  `dianhua` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '电话',
  `youxiang` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '邮箱',
  `qq` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'qq号',
  `jieshao` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '介绍',
  `create_time` int(255) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` int(255) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of xitong
-- ----------------------------
INSERT INTO `xitong` VALUES (1, '系统11', '山东德州', '13577777777', '63492473@qq.com', '63492473', '自动赚钱系统', NULL, 1536829769);

-- ----------------------------
-- Table structure for xuesheng
-- ----------------------------
DROP TABLE IF EXISTS `xuesheng`;
CREATE TABLE `xuesheng`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `banji` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `chengji` int(255) NULL DEFAULT NULL,
  `create_time` int(255) NULL DEFAULT NULL,
  `update_time` int(255) NULL DEFAULT NULL,
  `zhuangtai` int(255) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 61 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of xuesheng
-- ----------------------------
INSERT INTO `xuesheng` VALUES (1, '张三1', '1', 90, NULL, 1536399205, 1);
INSERT INTO `xuesheng` VALUES (2, '李四7', '2', 95, NULL, 1536397512, 1);
INSERT INTO `xuesheng` VALUES (3, '王五1', '1', 100, NULL, 1536397977, 1);
INSERT INTO `xuesheng` VALUES (4, '王五', '1', 100, NULL, NULL, 1);
INSERT INTO `xuesheng` VALUES (5, '王五', '1', 100, NULL, NULL, 1);
INSERT INTO `xuesheng` VALUES (6, '王五', '1', 100, NULL, NULL, 1);
INSERT INTO `xuesheng` VALUES (52, '测试时间', '2', 99, NULL, NULL, -1);
INSERT INTO `xuesheng` VALUES (37, '赵六', '5', 90, NULL, NULL, 1);
INSERT INTO `xuesheng` VALUES (36, '赵六', '5', 90, NULL, NULL, 1);
INSERT INTO `xuesheng` VALUES (35, '周八', '5', 90, NULL, NULL, 1);
INSERT INTO `xuesheng` VALUES (34, '周期1', '53', 902, NULL, 1536397439, 1);
INSERT INTO `xuesheng` VALUES (33, '赵六', '5', 90, NULL, 1536219037, -1);

-- ----------------------------
-- Table structure for youhua
-- ----------------------------
DROP TABLE IF EXISTS `youhua`;
CREATE TABLE `youhua`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `guanjianci` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `neirong` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `beian` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `update_time` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of youhua
-- ----------------------------
INSERT INTO `youhua` VALUES (1, '自动12', '赚钱', '212																																																', '备案', 1536999151);

-- ----------------------------
-- Table structure for zhaopinyongjin
-- ----------------------------
DROP TABLE IF EXISTS `zhaopinyongjin`;
CREATE TABLE `zhaopinyongjin`  (
  `id` int(20) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `dingdanhao` bigint(255) NULL DEFAULT NULL COMMENT '订单号',
  `wenzhangid` int(255) NULL DEFAULT NULL COMMENT '文章id',
  `shouruzheid` int(255) NULL DEFAULT NULL COMMENT '收入者id',
  `shouruzheleixing` int(255) NULL DEFAULT NULL COMMENT '收入者类型',
  `xueyuanid` int(255) NULL DEFAULT NULL COMMENT '学员id',
  `xueyuanleixing` int(20) NULL DEFAULT NULL COMMENT '学员类型',
  `jiesuanzhuangtai` int(20) NULL DEFAULT NULL COMMENT '结算状态',
  `shouru` decimal(20, 2) NULL DEFAULT 0.00 COMMENT '收入',
  `beizhu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  `zhuangtai` int(10) NULL DEFAULT 1 COMMENT '显示状态',
  `create_time` int(255) NULL DEFAULT NULL COMMENT '创建日期',
  `update_time` int(255) NULL DEFAULT NULL COMMENT '结算日期',
  `zuozheid` int(255) NULL DEFAULT NULL COMMENT '作者id',
  `zuozheleixing` int(255) NULL DEFAULT NULL COMMENT '作者类型',
  `jiesuandanhao` bigint(255) NULL DEFAULT NULL COMMENT '结算单号',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 317 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of zhaopinyongjin
-- ----------------------------
INSERT INTO `zhaopinyongjin` VALUES (316, 145108451541238625, 50, 1, 3, 5, 1, 2, 8.00, NULL, 1, 1541238625, 1541316932, 1, 3, 3987331544929869);

-- ----------------------------
-- Table structure for zhucexueyuan
-- ----------------------------
DROP TABLE IF EXISTS `zhucexueyuan`;
CREATE TABLE `zhucexueyuan`  (
  `id` int(255) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '登录名',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '登录密码',
  `code` int(255) NULL DEFAULT NULL COMMENT '随机码',
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '头像',
  `leixing` int(255) NULL DEFAULT 3 COMMENT '学员类型：1微信学员；2qq学员；3注册学员',
  `zhuangtai` tinyint(255) NULL DEFAULT NULL COMMENT '状态：1正常；-1拉黑',
  `tuijianxueyuanid` int(255) NULL DEFAULT NULL COMMENT '推荐学员的id',
  `tuijianxueyuanleixing` int(255) NULL DEFAULT NULL COMMENT '推荐学员的类型',
  `mobile` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '手机',
  `qqlianxi` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'QQ联系方式',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '邮箱',
  `yinhang` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '银行',
  `kaihuhang` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '开户行',
  `yinhangzhanghao` bigint(255) NULL DEFAULT NULL COMMENT '银行账号',
  `xingming` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '真实姓名',
  `create_time` int(255) NULL DEFAULT NULL COMMENT '注册日期',
  `update_time` int(255) NULL DEFAULT NULL COMMENT '最后登录时间',
  `shiufougonggaozhe` int(255) NULL DEFAULT 0 COMMENT '是否是供稿者：1是；2否',
  `denglucishu` int(255) NULL DEFAULT 0 COMMENT '登录次数',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 22 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of zhucexueyuan
-- ----------------------------
INSERT INTO `zhucexueyuan` VALUES (1, 'zhuce1', '4d42a7dc3d324356de9632f7af84ccf2', 9686, NULL, 3, 1, 4, 1, '13573', '6545', 'zidong@126.com', '中国建设银行1', '中国建设银行德州分行', 8888888888888888888, '网易云', NULL, 1545275928, 0, 0);
INSERT INTO `zhucexueyuan` VALUES (4, 'zhuce2', 'f39b0dc5b0cf65a6fe6c880ff98156a2', 537, NULL, 3, -1, 4, 1, '', NULL, '', '中国银行', '中国银行德州分行', 666666666666666666, '阿里云', 1538982234, 1544664165, 0, 0);
INSERT INTO `zhucexueyuan` VALUES (5, 'zhuce3', '2fdddc426480d46ce18affae5e455c82', 7364, NULL, 3, -1, 4, 1, '', NULL, '', NULL, NULL, NULL, NULL, 1538982288, 1544664125, 0, 0);
INSERT INTO `zhucexueyuan` VALUES (17, 'zhuce6', '493c56db82e83cfa5010804ddb6f3dbc', 4727, NULL, 3, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1545031085, 1545031085, 0, 0);
INSERT INTO `zhucexueyuan` VALUES (18, 'zhuce7', 'bddc45c4937a7b6a167b2dda69e0b333', 918, NULL, 3, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1545031392, 1545031392, 0, 0);
INSERT INTO `zhucexueyuan` VALUES (19, 'zhuce9', '566bef7974f939e0c1948da78d039fd7', 1395, NULL, 3, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1545031621, 1545031621, 0, 0);
INSERT INTO `zhucexueyuan` VALUES (20, 'zhuce99', 'd029a2c967a47a041d2d5c4bcd15db4a', 2687, NULL, 3, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0);
INSERT INTO `zhucexueyuan` VALUES (21, 'zhecu88', '4bd24ef0c623d4c9cde6fcd429dca743', 2848, NULL, 3, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1545034499, 1545034499, 0, 0);

SET FOREIGN_KEY_CHECKS = 1;
