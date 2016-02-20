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
    <link rel="stylesheet" href="/appsocks/Public/css/registe.css">
</head>

<body>
    <div class="top-nav">
        <nav class="navbar navbar-fixed-top">
            <div class="brand"><span class="glyphicon glyphicon-send" aria-hidden="true"></span><a href="<?php echo U('Home/Index/index');?>">AppSocks</a>- <span>您的加速科学上网助手</span></div>
            <div class="nav-list">
                <ul>
                    <li><a  href="/appsocks/index.php/Home/Index/menu">套餐订购</a></li>
                    <li><a href="/appsocks/index.php/Home/Help/download">客户端下载</a></li>
                    <li><a href="/appsocks/index.php/Home/Help/method">使用教程</a></li>
                    <li><a href="/appsocks/index.php/Home/Help/support">技术支持</a></li>
                    <li><?php echo session('?uid') ? ('<a href="/appsocks/index.php/Home/User/dashboard/uid/'.session('uid').'">'.session('nickname').'</a>') : '<a href="/appsocks/index.php/Home/Public/login">用户登录</a>'; ?></li>
                    <li><a class="active" href="/appsocks/index.php/Home/Public/registe">用户注册</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="main container">
        <div class="row">
            <div class="col-md-7 col-xs-12">
                    <img src="/appsocks/Public/pictures/register_logo.jpg" class="register_logo" alt="register_logo.jpg">
            </div>
            <div class="col-md-5 col-xs-12">
                <div class="log-pannel">
                    <div class="space-box col-md-12 col-sm-0"></div>
                    <p class="log-pannel-msg"><span>注册</span>成为<strong>AppSocks</strong>一员，开启高速科学上网体验</p>
                    <form action="/appsocks/index.php/Public/doRegiste" method="post">
                        <div class="form-group input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                <input type="text" class="form-control" name="nickname" placeholder="昵称" required>
                        </div>
                        <div class="form-group input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></span>
                                <input type="email" class="form-control" name="email" placeholder="电子邮箱" required>
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span></span>
                            <input type="password" class="form-control" name="password" placeholder="密码" required>
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span></span>
                            <input type="password" class="form-control" name="repassword" placeholder="确认密码" required>
                        </div>
                        <p>注册即表明同意遵守本站相关协议</p>
                        <button type="submit" class="btn btn-primary registe-btn">注册</button>
                    </form>
                    <a role="button" href="/appsocks/index.php/Home/Public/login">什么！已经有帐号？</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>