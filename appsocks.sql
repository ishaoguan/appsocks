-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-02-19 17:55:36
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

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
  `init_flow` int(11) DEFAULT '0' COMMENT '初始流量单位M',
  `invite` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否开启邀请',
  `registe` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否开启注册',
  `signin` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否开启签到',
  `signin_interval` tinyint(2) NOT NULL DEFAULT '22' COMMENT '签到间隔 单位小时',
  `signin_max` int(11) NOT NULL DEFAULT '100' COMMENT '最大签到流量单位M',
  `signin_min` tinyint(4) DEFAULT '10' COMMENT '最小签到流量单位M',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `config`
--

INSERT INTO `config` (`id`, `init_flow`, `invite`, `registe`, `signin`, `signin_interval`, `signin_max`, `signin_min`) VALUES
(1, 0, 1, 1, 1, 22, 100, 10);

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
  `lid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `nickname` varchar(12) NOT NULL,
  `password` char(40) NOT NULL,
  `invite` int(11) NOT NULL DEFAULT '0',
  `actived` int(11) NOT NULL DEFAULT '0',
  `last_login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login_ip` char(15) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `admin` tinyint(4) NOT NULL DEFAULT '0' COMMENT '默认0为普通成员',
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `login`
--

INSERT INTO `login` (`lid`, `uid`, `email`, `nickname`, `password`, `invite`, `actived`, `last_login_time`, `last_login_ip`, `create_time`, `admin`) VALUES
(1, 1, 'www@qq.com', 'qq', 'eeeeeeeeeeeeeeeewqewqqq', 0, 1, '2016-02-19 05:55:49', '0.0.0.0', '2016-02-19 05:55:49', 0);

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
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `order_record`
--

INSERT INTO `order_record` (`oid`, `uid`, `cid`, `purchase_time`, `expire_time`, `cost`, `success`) VALUES
(1, 7, 1, '2016-02-19 10:13:26', '2016-02-29 10:35:53', 15, 1);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(32) NOT NULL,
  `pass` varchar(16) NOT NULL,
  `passwd` varchar(16) NOT NULL,
  `t` int(11) NOT NULL DEFAULT '0',
  `u` bigint(20) NOT NULL,
  `d` bigint(20) NOT NULL,
  `transfer_enable` bigint(20) NOT NULL,
  `port` int(11) NOT NULL,
  `switch` tinyint(4) NOT NULL DEFAULT '1',
  `enable` tinyint(4) NOT NULL DEFAULT '1',
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `last_get_gift_time` int(11) NOT NULL DEFAULT '0',
  `last_rest_pass_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`port`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=415 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `email`, `pass`, `passwd`, `t`, `u`, `d`, `transfer_enable`, `port`, `switch`, `enable`, `type`, `last_get_gift_time`, `last_rest_pass_time`) VALUES
(7, 'test@test.com', '123456', '0000000', 1410609560, 342340, 4646460, 9320666234, 50000, 1, 1, 7, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
