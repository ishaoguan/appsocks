-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-02-23 13:02:05
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
-- 表的结构 `ss_combo`
--

CREATE TABLE IF NOT EXISTS `ss_combo` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `nid` int(11) NOT NULL COMMENT '节点id',
  `flow` int(11) NOT NULL COMMENT '流量 单位M',
  `duration` int(11) NOT NULL COMMENT '时长 单位天',
  `cost` int(11) NOT NULL COMMENT '费用 单位元',
  `title` char(20) NOT NULL COMMENT '套餐名称',
  `remark` varchar(300) DEFAULT NULL COMMENT '套餐备注',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '默认1为可用',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `ss_combo`
--

INSERT INTO `ss_combo` (`cid`, `nid`, `flow`, `duration`, `cost`, `title`, `remark`, `status`) VALUES
(1, 1, 51200, 30, 15, '套餐一：月付', '假期优惠中', 1),
(2, 1, 102400, 30, 50, '游戏套餐', '高速低延迟', 1),
(3, 1, 1024000, 365, 2000, '企业套餐', '小型企业必备,线路专有', 0);

-- --------------------------------------------------------

--
-- 表的结构 `ss_config`
--

CREATE TABLE IF NOT EXISTS `ss_config` (
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
-- 转存表中的数据 `ss_config`
--

INSERT INTO `ss_config` (`id`, `init_flow`, `invite`, `registe`, `signin`, `signin_interval`, `signin_max`, `signin_min`, `port_start`, `announcement`) VALUES
(1, 0, 1, 1, 1, 22, 100, 10, 5000, '欢迎使用AppSocks服务');

-- --------------------------------------------------------

--
-- 表的结构 `ss_invite`
--

CREATE TABLE IF NOT EXISTS `ss_invite` (
  `iid` int(11) NOT NULL AUTO_INCREMENT,
  `invite_uid` int(11) NOT NULL COMMENT '邀请人id',
  `being_invited_uid` int(11) NOT NULL COMMENT '被邀请人id',
  `being_invited_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '被邀请时间',
  `actived` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否激活',
  PRIMARY KEY (`iid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ss_invite_code`
--

CREATE TABLE IF NOT EXISTS `ss_invite_code` (
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
-- 表的结构 `ss_login`
--

CREATE TABLE IF NOT EXISTS `ss_login` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `nickname` varchar(12) NOT NULL,
  `password` char(40) NOT NULL,
  `invite` int(11) NOT NULL DEFAULT '0',
  `actived` int(11) NOT NULL DEFAULT '0',
  `last_login_time` timestamp NULL DEFAULT NULL,
  `last_login_ip` char(15) NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `admin` tinyint(4) NOT NULL DEFAULT '0' COMMENT '默认0为普通成员',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `ss_login`
--

INSERT INTO `ss_login` (`uid`, `email`, `nickname`, `password`, `invite`, `actived`, `last_login_time`, `last_login_ip`, `create_time`, `admin`) VALUES
(1, 'admin@admin.com', 'amdin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, 1, '2016-02-23 10:18:11', '0.0.0.0', '2016-02-23 09:54:02', 1);

-- --------------------------------------------------------

--
-- 表的结构 `ss_node`
--

CREATE TABLE IF NOT EXISTS `ss_node` (
  `nid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT NULL COMMENT '对应套餐id',
  `name` varchar(128) NOT NULL,
  `server_ip` varchar(128) NOT NULL,
  `domain_name` varchar(30) NOT NULL COMMENT '服务器域名，方便记忆',
  `method` varchar(64) NOT NULL COMMENT '加密方式',
  `remark` varchar(200) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT '1' COMMENT '默认1为可用',
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `ss_node`
--

INSERT INTO `ss_node` (`nid`, `cid`, `name`, `server_ip`, `domain_name`, `method`, `remark`, `status`) VALUES
(1, 1, '西雅图高速节点', '107.191.104.103', 'appsocks.net', 'rc4-md5', '站长推荐', 1),
(2, NULL, '本地测试', '10.1.1.1', 'www.baidu.com', 'rc4-md5', '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `ss_orders`
--

CREATE TABLE IF NOT EXISTS `ss_orders` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `cid` int(11) NOT NULL,
  `submit_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '提交订单时间',
  `remark` text COMMENT '订单备注',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '默认1为未处理',
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `ss_orders`
--

INSERT INTO `ss_orders` (`oid`, `uid`, `cid`, `submit_time`, `remark`, `status`) VALUES
(1, 1, 2, '2016-02-23 10:18:26', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `ss_order_record`
--

CREATE TABLE IF NOT EXISTS `ss_order_record` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `cid` int(11) NOT NULL COMMENT '套餐id',
  `purchase_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '购买时间',
  `expire_time` timestamp NOT NULL COMMENT '到期时间',
  `cost` int(11) NOT NULL COMMENT '费用',
  `success` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否购买成功',
  `sid` int(11) DEFAULT NULL COMMENT '开启的服务id',
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `ss_order_record`
--

INSERT INTO `ss_order_record` (`oid`, `uid`, `cid`, `purchase_time`, `expire_time`, `cost`, `success`, `sid`) VALUES
(1, 1, 2, '2016-02-22 22:18:32', '2016-03-23 22:18:32', 50, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ss_user`
--

CREATE TABLE IF NOT EXISTS `ss_user` (
  `port` int(11) NOT NULL AUTO_INCREMENT,
  `passwd` varchar(16) NOT NULL,
  `t` int(11) NOT NULL DEFAULT '0',
  `u` bigint(20) NOT NULL,
  `d` bigint(20) NOT NULL,
  `transfer_enable` bigint(20) NOT NULL COMMENT '总分配的流量',
  `last_get_gift_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`port`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `ss_user`
--

INSERT INTO `ss_user` (`port`, `passwd`, `t`, `u`, `d`, `transfer_enable`, `last_get_gift_time`) VALUES
(1, '232412', 0, 0, 0, 107374182400, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
