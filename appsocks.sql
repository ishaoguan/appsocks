-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Feb 24, 2016 at 04:08 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `appsocks`
--

-- --------------------------------------------------------

--
-- Table structure for table `combo`
--

CREATE TABLE `combo` (
  `cid` int(11) NOT NULL,
  `nid` int(11) NOT NULL COMMENT '节点id',
  `flow` int(11) NOT NULL COMMENT '流量 单位M',
  `duration` int(11) NOT NULL COMMENT '时长 单位天',
  `cost` int(11) NOT NULL COMMENT '费用 单位元',
  `title` char(20) NOT NULL COMMENT '套餐名称',
  `remark` varchar(300) DEFAULT NULL COMMENT '套餐备注',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '默认1为可用'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `combo`
--

INSERT INTO `combo` (`cid`, `nid`, `flow`, `duration`, `cost`, `title`, `remark`, `status`) VALUES
(1, 1, 51200, 30, 15, '套餐一：月付', '假期优惠中', 1),
(2, 1, 102400, 30, 50, '游戏套餐', '高速低延迟', 1),
(3, 1, 1024000, 365, 2000, '企业套餐', '小型企业必备,线路专有', 0),
(4, 2, 10240, 10, 10, '测试', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `init_flow` int(11) NOT NULL DEFAULT '0' COMMENT '初始流量单位M',
  `invite` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否开启邀请',
  `registe` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否开启注册',
  `signin` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否开启签到',
  `signin_interval` tinyint(2) NOT NULL DEFAULT '22' COMMENT '签到间隔 单位小时',
  `signin_max` int(11) NOT NULL DEFAULT '100' COMMENT '最大签到流量单位M',
  `signin_min` tinyint(4) NOT NULL DEFAULT '10' COMMENT '最小签到流量单位M',
  `port_start` int(11) NOT NULL DEFAULT '5000' COMMENT '起始端口',
  `announcement` text COMMENT '公告'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `init_flow`, `invite`, `registe`, `signin`, `signin_interval`, `signin_max`, `signin_min`, `port_start`, `announcement`) VALUES
(1, 0, 1, 1, 1, 22, 100, 10, 5000, '欢迎使用AppSocks服务');

-- --------------------------------------------------------

--
-- Table structure for table `invite`
--

CREATE TABLE `invite` (
  `iid` int(11) NOT NULL,
  `invite_uid` int(11) NOT NULL COMMENT '邀请人id',
  `being_invited_uid` int(11) NOT NULL COMMENT '被邀请人id',
  `being_invited_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '被邀请时间',
  `actived` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否激活'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invite_code`
--

CREATE TABLE `invite_code` (
  `cid` int(11) NOT NULL,
  `uid` int(11) NOT NULL COMMENT '创建者id',
  `code` varchar(100) NOT NULL COMMENT '邀请码',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `actived` tinyint(4) DEFAULT '0' COMMENT '是否激活',
  `type` tinyint(2) DEFAULT '0' COMMENT '邀请码类型 0仅自己可见 1所有人可见'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `uid` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `nickname` varchar(12) NOT NULL,
  `password` char(40) NOT NULL,
  `invite` int(11) NOT NULL DEFAULT '0',
  `actived` int(11) NOT NULL DEFAULT '0',
  `last_login_time` timestamp NULL DEFAULT NULL,
  `last_login_ip` char(15) NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `admin` tinyint(4) NOT NULL DEFAULT '0' COMMENT '默认0为普通成员'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`uid`, `email`, `nickname`, `password`, `invite`, `actived`, `last_login_time`, `last_login_ip`, `create_time`, `admin`) VALUES
(1, 'admin@admin.com', 'amdin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, 1, '2016-02-24 22:24:13', '0.0.0.0', '2016-02-23 09:54:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `node`
--

CREATE TABLE `node` (
  `nid` int(11) NOT NULL,
  `cid` int(11) DEFAULT NULL COMMENT '对应套餐id',
  `name` varchar(128) NOT NULL,
  `server_ip` varchar(128) NOT NULL,
  `domain_name` varchar(30) NOT NULL COMMENT '服务器域名，方便记忆',
  `method` varchar(64) NOT NULL COMMENT '加密方式',
  `remark` varchar(200) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT '1' COMMENT '默认1为可用'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `node`
--

INSERT INTO `node` (`nid`, `cid`, `name`, `server_ip`, `domain_name`, `method`, `remark`, `status`) VALUES
(1, 1, '西雅图高速节点', '107.191.104.103', 'appsocks.net', 'rc4-md5', '站长推荐', 1),
(2, NULL, '本地测试', '10.1.1.1', 'www.baidu.com', 'rc4-md5', '', 1),
(3, NULL, '测试', '10.1.2.3', '测试', 'rc4-md5', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `oid` int(11) NOT NULL,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `cid` int(11) NOT NULL,
  `submit_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '提交订单时间',
  `remark` text COMMENT '订单备注',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '默认1为未处理'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`oid`, `uid`, `cid`, `submit_time`, `remark`, `status`) VALUES
(1, 1, 2, '2016-02-23 10:18:26', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_record`
--

CREATE TABLE `order_record` (
  `oid` int(11) NOT NULL,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `cid` int(11) NOT NULL COMMENT '套餐id',
  `purchase_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '购买时间',
  `expire_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '到期时间',
  `cost` int(11) NOT NULL COMMENT '费用',
  `success` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否购买成功',
  `sid` int(11) DEFAULT NULL COMMENT '开启的服务id'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_record`
--

INSERT INTO `order_record` (`oid`, `uid`, `cid`, `purchase_time`, `expire_time`, `cost`, `success`, `sid`) VALUES
(1, 1, 2, '2016-02-22 22:18:32', '2016-03-23 22:18:32', 50, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `port` int(11) NOT NULL,
  `passwd` varchar(16) NOT NULL,
  `t` int(11) NOT NULL DEFAULT '0',
  `u` bigint(20) NOT NULL,
  `d` bigint(20) NOT NULL,
  `transfer_enable` bigint(20) NOT NULL COMMENT '总分配的流量',
  `switch` int(11) NOT NULL DEFAULT '1',
  `enable` int(11) NOT NULL DEFAULT '1',
  `last_get_gift_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5000 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`port`, `passwd`, `t`, `u`, `d`, `transfer_enable`, `switch`, `enable`, `last_get_gift_time`) VALUES
(5001, '232412', 0, 0, 0, 107374182400, 1, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `combo`
--
ALTER TABLE `combo`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invite`
--
ALTER TABLE `invite`
  ADD PRIMARY KEY (`iid`);

--
-- Indexes for table `invite_code`
--
ALTER TABLE `invite_code`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `node`
--
ALTER TABLE `node`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `order_record`
--
ALTER TABLE `order_record`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`port`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `combo`
--
ALTER TABLE `combo`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `invite`
--
ALTER TABLE `invite`
  MODIFY `iid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invite_code`
--
ALTER TABLE `invite_code`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `node`
--
ALTER TABLE `node`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `order_record`
--
ALTER TABLE `order_record`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `port` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;