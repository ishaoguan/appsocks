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
                    <li><a class="active" href="/appsocks/index.php/Home/Public/login">用户登录</a></li>
                    <li><a href="/appsocks/index.php/Home/Public/registe">用户注册</a></li>
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
                    <p class="log-pannel-msg"><span>登录</span><strong>Appsocks</strong>,一秒都等不及了</p>
                    <form action="/appsocks/index.php/Public/doLogin" method="post">
                        <div class="form-group input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></span>
                                <input type="email" class="form-control" name="email" placeholder="电子邮箱" required>
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span></span>
                            <input type="password" class="form-control" name="password" placeholder="密码" required>
                        </div>
                        <button type="submit" class="btn btn-primary registe-btn">登录</button>
                    </form>
                    <a role="button" href="/appsocks/index.php/Home/Public/registe">听说你还没有帐号？</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>