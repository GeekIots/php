/*
Navicat MySQL Data Transfer

Source Server         : root
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : web

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2017-09-30 15:16:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(32) DEFAULT '' COMMENT '系统自动生成的用户id',
  `nickname` varchar(20) DEFAULT NULL COMMENT '用户名',
  `password` varchar(32) DEFAULT NULL COMMENT '用户密码',
  `avatar` varchar(100) DEFAULT NULL COMMENT '用户头像',
  `sex` varchar(1) DEFAULT '1' COMMENT '性别字段,0，女性，1，男性',
  `phonenumber` varchar(18) DEFAULT NULL COMMENT '电话号码',
  `email` varchar(30) DEFAULT NULL COMMENT '邮箱',
  `city` varchar(30) DEFAULT NULL COMMENT '城市',
  `describe` varchar(100) DEFAULT NULL COMMENT '用户签名',
  `qq` varchar(15) DEFAULT NULL COMMENT 'qq号',
  `level` varchar(10) DEFAULT '1' COMMENT '用户等级',
  `value` int(11) DEFAULT '0' COMMENT '用户积分',
  `regtime` datetime DEFAULT NULL COMMENT '注册时间',
  `active` varchar(8) DEFAULT '0' COMMENT '激活状态',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '00000000000000000000000000000000', '幽灵', 'ccff585581a620ced8e52c476cabf15f', 'image/avatar/20170917/20170917160838.png', '1', '15339287330', '0@126.com', '西安', '为理想而奋斗！', '5742872540', '1', '100', '2017-08-15 17:07:54', '1');
INSERT INTO `user` VALUES ('2', '11111111111111111111111111111111', '吃瓜群众', 'ccff585581a620ced8e52c476cabf15f', 'image/avatar/20170917/20170917160838.png', '1', '15339287331', '1@126.com', '北京', '世界辣么大，我想去走走！', '5742872541', '2', '200', '2017-08-02 05:07:54', '1');
INSERT INTO `user` VALUES ('61', '22222222222222222222222222222222', '友谊的小船说翻就翻', 'ccff585581a620ced8e52c476cabf15f', 'image/avatar/20170917/20170917160838.png', '1', '15339287332', '2@126.com', '上海', '理想还是要有的，反正又实现不了！', '5742872542', '3', '30', '2017-08-18 17:07:38', '1');
INSERT INTO `user` VALUES ('62', '33333333333333333333333333333333', '一言不合就xx', 'ccff585581a620ced8e52c476cabf15f', 'image/avatar/20170917/20170917160838.png', '1', '15339287333', '3@126.com', '深圳', '为物联网而生！', '5742872543', '4', '50', '2017-08-25 10:07:54', '1');
