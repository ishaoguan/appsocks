<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>AppSocks - 科学上网您最好的选择</title>
    <base target="mainiframe" />
    <link href="/appsocks/Public/pictures/logo.ico" rel="shortcut icon">
    <!-- Bootstrap 文件 -->
    <link rel="stylesheet" href="/appsocks/Public/css/bootstrap.min.css">
    <script src="/appsocks/Public/js/jquery.min.js"></script>
    <script src="/appsocks/Public/js/bootstrap.min.js"></script>
    <!-- 字体文件 -->
    <link rel="stylesheet" href="/appsocks/Public/css/typo.css">
    <!-- 自定义css文件 -->
    <link rel="stylesheet" href="/appsocks/Public/css/default.css">
    <link rel="stylesheet" href="/appsocks/Public/css/dashboard.css">
    <script type="text/javascript" src="/appsocks/Public/js/iframe.js"></script>
</head>

<body>
    <div class="top-nav">
        <nav class="navbar navbar-fixed-top">
            <div class="brand"><span class="glyphicon glyphicon-send" aria-hidden="true"></span><a href="http://appsocks.net">AppSocks</a>- <span>您的加速科学上网助手</span></div>
            <div class="nav-list">
                <ul>
                    <li><a href="/appsocks/index.php/Home/Index/menu">套餐订购</a></li>
                    <li><a href="/appsocks/index.php/Home/Help/download">客户端下载</a></li>
                    <li><a href="/appsocks/index.php/Home/Help/method">使用教程</a></li>
                    <li><a href="/appsocks/index.php/Home/Help/support">技术支持</a></li>
                    <li><a href="/appsocks/index.php/Home/Public/login">登录</a></li>
                    <li><a href="/appsocks/index.php/Home/Public/signIn">注册</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="main container">
        <div class="row">
            <div class="col-sm-2 col-lg-2">
                <div class="sidebar-nav">
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li><a href="<?php echo U('Home/Admin/statistics');?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> 站点统计</a></li>
                        <li><a href="<?php echo U('Home/Admin/userManage');?>"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 用户管理</a></li>
                        <li><a href="<?php echo U('Home/Admin/comboManage');?>"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span> 套餐管理</a></li>
                        <li><a href="<?php echo U('Home/Admin/nodeManage');?>"><span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span> 节点管理</a></li>
                        <li><a href="<?php echo U('Home/Admin/inviteManage');?>"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span> 邀请管理</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-10 col-lg-10" id="content">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" name="mainiframe" src="<?php echo U('Admin/statistics');?>"></iframe>
                </div>
            </div>
        </div>
    </div>

</body>

</html>