/*
 Navicat Premium Data Transfer

 Source Server         : MAC [DEVELOPMENT]
 Source Server Type    : MySQL
 Source Server Version : 50534
 Source Host           : localhost
 Source Database       : prezentacjaZF2

 Target Server Type    : MySQL
 Target Server Version : 50534
 File Encoding         : utf-8

 Date: 08/16/2014 18:54:37 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `schedule`
-- ----------------------------
DROP TABLE IF EXISTS `schedule`;
CREATE TABLE `schedule` (
  `schedule_id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  PRIMARY KEY (`schedule_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `schedule`
-- ----------------------------
BEGIN;
INSERT INTO `schedule` VALUES ('1', 'competition', 'photo-upload', '2014-07-22 00:00:00', '2014-07-22 23:59:59'), ('2', 'competition', 'moderator-accept', '2014-07-23 00:00:00', '2014-07-31 23:59:59'), ('3', 'competition', 'voting', '2014-08-01 00:00:00', '2014-08-16 23:59:59');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
