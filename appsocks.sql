-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-02-21 03:06:53
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `appsocks`
--

-- --------------------------------------------------------

--
-- 表的结构 `combo`
--

CREATE TABLE IF NOT EXISTS `combo` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `flow` int(11) NOT NULL COMMENT '流量 单位M',
  `duration` int(11) NOT NULL COMMENT '时长 单位天',
  `cost` int(11) NOT NULL COMMENT '费用 单位元',
  `title` char(20) NOT NULL COMMENT '套餐名称',
  `remark` varchar(300) DEFAULT NULL COMMENT '套餐备注',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '默认1为可用',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `combo`
--

INSERT INTO `combo` (`cid`, `flow`, `duration`, `cost`, `title`, `remark`, `status`) VALUES
(1, 51200, 30, 15, '套餐一：月付', '假期优惠中', 1),
(2, 102400, 30, 50, '游戏套餐', '高速低延迟', 1),
(3, 1024000, 365, 2000, '企业套餐', '小型企业必备,线路专有', 1);

-- --------------------------------------------------------

--
-- 表的结构 `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `init_flow` int(11) NOT NULL DEFAULT '0' COMMENT '初始流量单位M',
  `invite` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否开启邀请',
  `registe` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否开启注册',
  `signin` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否开启签到',
  `signin_interval` tinyint(2) NOT NULL DEFAULT '22' COMMENT '签到间隔 单位小时',
  `signin_max` int(11) NOT NULL DEFAULT '100' COMMENT '最大签到流量单位M',
  `signin_min` tinyint(4) NOT NULL DEFAULT '10' COMMENT '最小签到流量单位M',
  `port_start` int(11) NOT NULL DEFAULT '5000' COMMENT '起始端口',
  `announcement` text COMMENT '公告',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `config`
--

INSERT INTO `config` (`id`, `init_flow`, `invite`, `registe`, `signin`, `signin_interval`, `signin_max`, `signin_min`, `port_start`, `announcement`) VALUES
(1, 0, 1, 1, 1, 22, 100, 10, 5000, '欢迎使用AppSocks服务');

-- --------------------------------------------------------

--
-- 表的结构 `invite`
--

CREATE TABLE IF NOT EXISTS `invite` (
  `iid` int(11) NOT NULL AUTO_INCREMENT,
  `invite_uid` int(11) NOT NULL COMMENT '邀请人id',
  `being_invited_uid` int(11) NOT NULL COMMENT '被邀请人id',
  `being_invited_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '被邀请时间',
  `actived` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否激活',
  PRIMARY KEY (`iid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `invite_code`
--

CREATE TABLE IF NOT EXISTS `invite_code` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '创建者id',
  `code` varchar(100) NOT NULL COMMENT '邀请码',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `actived` tinyint(4) DEFAULT '0' COMMENT '是否激活',
  `type` tinyint(2) DEFAULT '0' COMMENT '邀请码类型 0仅自己可见 1所有人可见',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `nickname` varchar(12) NOT NULL,
  `password` char(40) NOT NULL,
  `invite` int(11) NOT NULL DEFAULT '0',
  `actived` int(11) NOT NULL DEFAULT '0',
  `last_login_time` timestamp NULL DEFAULT NULL,
  `last_login_ip` char(15) NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `admin` tinyint(4) NOT NULL DEFAULT '0' COMMENT '默认0为普通成员',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `login`
--

INSERT INTO `login` (`uid`, `email`, `nickname`, `password`, `invite`, `actived`, `last_login_time`, `last_login_ip`, `create_time`, `admin`) VALUES
(1, 'www@qq.com', 'qq', 'eeeeeeeeeeeeeeeewqewqqq', 0, 1, '2016-02-19 05:55:49', '0.0.0.0', '2016-02-19 05:55:49', 0),
(2, 'admin@admin.com', 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, 1, '2016-02-20 16:50:01', '0.0.0.0', '2016-02-20 04:14:20', 1);

-- --------------------------------------------------------

--
-- 表的结构 `node`
--

CREATE TABLE IF NOT EXISTS `node` (
  `nid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL COMMENT '对应套餐id',
  `name` varchar(128) NOT NULL,
  `server` varchar(128) NOT NULL,
  `method` varchar(64) NOT NULL,
  `remark` varchar(200) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT '1' COMMENT '默认1为可用',
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `node`
--

INSERT INTO `node` (`nid`, `cid`, `name`, `server`, `method`, `remark`, `status`) VALUES
(1, 1, '西雅图高速节点', 'us.appsocks.net', 'rc4-md5', '站长推荐', 1);

-- --------------------------------------------------------

--
-- 表的结构 `order_record`
--

CREATE TABLE IF NOT EXISTS `order_record` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `cid` int(11) NOT NULL COMMENT '套餐id',
  `purchase_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '购买时间',
  `expire_time` timestamp NOT NULL,
  `cost` int(11) NOT NULL COMMENT '费用',
  `success` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否购买成功',
  `sid` int(11) NOT NULL COMMENT '开启的服务id',
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `order_record`
--

INSERT INTO `order_record` (`oid`, `uid`, `cid`, `purchase_time`, `expire_time`, `cost`, `success`, `sid`) VALUES
(1, 7, 1, '2016-02-19 10:13:26', '2016-02-29 10:35:53', 15, 1, 7),
(2, 2, 1, '2016-02-07 05:27:26', '2016-02-23 16:00:00', 15, 1, 8),
(3, 2, 1, '2016-02-01 05:27:26', '2016-02-20 07:47:03', 15, 1, 416);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `passwd` varchar(16) NOT NULL,
  `t` int(11) NOT NULL DEFAULT '0',
  `u` bigint(20) NOT NULL,
  `d` bigint(20) NOT NULL,
  `transfer_enable` bigint(20) NOT NULL COMMENT '总分配的流量',
  `port` int(11) NOT NULL,
  `last_get_gift_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sid`,`port`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=419 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`sid`, `passwd`, `t`, `u`, `d`, `transfer_enable`, `port`, `last_get_gift_time`) VALUES
(7, '0000000', 1410609560, 342340, 4646460, 0, 50000, 0),
(8, '111111', 0, 234320, 132320, 6745345436, 5001, 0),
(416, '44444', 0, 3, 666, 635634235346, 500003, 0),
(417, '565434', 0, 3, 666, 0, 50001, 0),
(418, '111431', 0, 234320, 132320, 6745345436, 34301, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
