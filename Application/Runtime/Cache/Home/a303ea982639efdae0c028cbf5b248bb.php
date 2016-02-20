<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>AppSocks - 科学上网您最好的选择</title>
    <link href="/appsocks/Public/pictures/logo.ico" rel="shortcut icon">
    <!-- Bootstrap 文件 -->
    <link rel="stylesheet" href="/appsocks/Public/css/bootstrap.min.css">
    <script src="/appsocks/Public/js/jquery.min.js"></script>
    <script src="/appsocks/Public/js/bootstrap.min.js"></script>
    <!-- 字体文件 -->
    <link rel="stylesheet" href="/appsocks/Public/css/typo.css">
    <!-- 自定义css文件 -->
    <link rel="stylesheet" href="/appsocks/Public/css/default.css">
    <link rel="stylesheet" href="/appsocks/Public/css/menu.css">
</head>

<body>
    <div class="top-nav">
        <nav class="navbar navbar-fixed-top">
            <div class="brand"><span class="glyphicon glyphicon-send" aria-hidden="true"></span><a href="<?php echo U('Home/Index/index');?>">AppSocks</a>- <span>您的加速科学上网助手</span></div>
            <div class="nav-list">
                <ul>
                    <li><a class="active" href="/appsocks/index.php/Home/Index/menu">套餐订购</a></li>
                    <li><a href="/appsocks/index.php/Home/Help/download">客户端下载</a></li>
                    <li><a href="/appsocks/index.php/Home/Help/method">使用教程</a></li>
                    <li><a href="/appsocks/index.php/Home/Help/support">技术支持</a></li>
                    <li><?php echo session('?uid') ? ('<a href="/appsocks/index.php/Home/User/dashboard">'.session('nickname').'</a>') : '<a href="/appsocks/index.php/Home/Public/login">用户登录</a>'; ?></li>
                    <li><?php echo session('?uid') ? '<a href="/appsocks/index.php/Public/logout">退出</a>' : '<a href="/appsocks/index.php/Home/Public/registe">用户注册</a>'; ?></li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="main container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">套餐一：月付</div>
                    <div class="panel-body">
                        <p>每月50GB流量</p>
                        <p>美国/日本</p>
                        <p>同时连接2台设备</p>
                        <p>UDP转发：不支持</p>
                        <p>在线维基、网站服务单、QQ群</p>
                        <p>支持Mac OS X / Windows / Android / iOS / Linux</p>
                        <p>30天</p>
                        <a type="role" class="btn btn-primary" href="/appsocks/index.php/Index/cart/mid/1">立即订购</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">套餐二：年付</h3>
                    </div>
                    <div class="panel-body">
                        <p>每月50GB流量</p>
                        <p>美国/日本</p>
                        <p>同时连接2台设备</p>
                        <p>UDP转发：不支持</p>
                        <p>在线维基、网站服务单、QQ群、VIP客服</p>
                        <p>支持Mac OS X / Windows / Android / iOS / Linux</p>
                        <p>365天</p>
                        <a role="button" class="btn btn-primary" href="/appsocks/index.php/Index/cart/mid/2">立即订购</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">套餐三：敬请期待</h3>
                    </div>
                    <div class="panel-body">
                        <p>敬请期待</p>
                        <p>敬请期待</p>
                        <p>敬请期待</p>
                        <p>敬请期待</p>
                        <p>敬请期待</p>
                        <p>敬请期待</p>
                        <a role="button" class="btn btn-primary" href="/appsocks/index.php/Index/cart/mid/3">立即订购</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>