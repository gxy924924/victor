/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : sorand

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2017-06-08 16:25:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `mariah_production`
-- ----------------------------
DROP TABLE IF EXISTS `mariah_production`;
CREATE TABLE `mariah_production` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `production` varchar(11) DEFAULT NULL,
  `money` float(11,2) DEFAULT NULL,
  `discount` float(11,2) DEFAULT NULL,
  `price` float(11,2) DEFAULT NULL,
  `f_img` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mariah_production
-- ----------------------------
INSERT INTO `mariah_production` VALUES ('28', '', '0.00', '0.00', '0.00', null);
INSERT INTO `mariah_production` VALUES ('27', '', '0.00', '0.00', '0.00', null);
INSERT INTO `mariah_production` VALUES ('26', '', '0.00', '0.00', '0.00', null);
INSERT INTO `mariah_production` VALUES ('25', '', '0.00', '0.00', '0.00', null);
INSERT INTO `mariah_production` VALUES ('10', '00', '0.00', '0.00', '0.00', null);
INSERT INTO `mariah_production` VALUES ('11', '00', '0.00', '0.00', '0.00', null);
INSERT INTO `mariah_production` VALUES ('12', '00', '0.00', '0.00', '0.00', null);
INSERT INTO `mariah_production` VALUES ('13', '00', '0.00', '0.00', '0.00', null);
INSERT INTO `mariah_production` VALUES ('14', '00', '0.00', '0.00', '0.00', null);
INSERT INTO `mariah_production` VALUES ('15', '00', '0.00', '0.00', '0.00', null);
INSERT INTO `mariah_production` VALUES ('16', '00', '0.00', '0.00', '0.00', null);
INSERT INTO `mariah_production` VALUES ('17', '00', '0.00', '0.00', '0.00', null);
INSERT INTO `mariah_production` VALUES ('18', '', '0.00', '0.00', '0.00', '3b0f55d760d562ab9de51caf5094beb2.png');
INSERT INTO `mariah_production` VALUES ('19', '', '0.00', '0.00', '0.00', '模板1.jpg');
INSERT INTO `mariah_production` VALUES ('20', '', '0.00', '0.00', '0.00', '模板1.jpg');
INSERT INTO `mariah_production` VALUES ('21', '', '0.00', '0.00', '0.00', null);
INSERT INTO `mariah_production` VALUES ('22', '', '0.00', '0.00', '0.00', null);
INSERT INTO `mariah_production` VALUES ('23', '', '0.00', '0.00', '0.00', null);
INSERT INTO `mariah_production` VALUES ('24', '', '0.00', '0.00', '0.00', null);
INSERT INTO `mariah_production` VALUES ('29', '', '0.00', '0.00', '0.00', 'uploads/20170608/1d9e4e8b75796d6a81c39e9eba13abef.png');
INSERT INTO `mariah_production` VALUES ('30', '', '0.00', '0.00', '0.00', 'uploads/20170608/23478b699637ab82a53e31925f68c8b9.sql');
INSERT INTO `mariah_production` VALUES ('31', '', '0.00', '0.00', '0.00', 'uploads/20170608/5702de525236ca8ff689d5e3a3108d17.jpg');
INSERT INTO `mariah_production` VALUES ('32', '', '0.00', '0.00', '0.00', 'uploads/20170608/15fff4311010712a71ce6b7072ad16c2.sql');
INSERT INTO `mariah_production` VALUES ('33', '', '0.00', '0.00', '0.00', 'uploads/20170608/b651d78be9eb59902c03ad50f27b9f38.sql');
INSERT INTO `mariah_production` VALUES ('34', '', '0.00', '0.00', '0.00', 'uploads/20170608/f1274ab3ebc200d4b4fccefca7805f69.sql');

-- ----------------------------
-- Table structure for `mariah_shopstore`
-- ----------------------------
DROP TABLE IF EXISTS `mariah_shopstore`;
CREATE TABLE `mariah_shopstore` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shopname` varchar(11) CHARACTER SET utf8 NOT NULL,
  `position` varchar(100) CHARACTER SET utf8 NOT NULL,
  `tel` int(11) DEFAULT NULL,
  `qq` int(11) DEFAULT NULL,
  `weixin` int(11) DEFAULT NULL,
  `position_num` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of mariah_shopstore
-- ----------------------------
INSERT INTO `mariah_shopstore` VALUES ('2', '000', '00', '0', '0', '0', null);
INSERT INTO `mariah_shopstore` VALUES ('3', '000', '00', '0', '0', '0', null);
INSERT INTO `mariah_shopstore` VALUES ('4', '玛瑞娅', '软件园二期', '123456', '0', '0', null);
INSERT INTO `mariah_shopstore` VALUES ('5', '厦门', '厦门', '123456', '0', '0', null);
INSERT INTO `mariah_shopstore` VALUES ('6', '玛瑞娅厦门湖里万达店', '福建省厦门市湖里区万达', '400', '111111', '111111', null);
INSERT INTO `mariah_shopstore` VALUES ('7', '', '内蒙古-乌海市-海勃湾区', '0', '0', '0', '8-154-849');
INSERT INTO `mariah_shopstore` VALUES ('8', '', '黑龙江省-鸡西市-恒山区', '0', '0', '0', '11-189-1128');
INSERT INTO `mariah_shopstore` VALUES ('9', '', '河北省-秦皇岛市-山海关区11111111111111', '0', '0', '0', '6-132-578');
