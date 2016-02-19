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
    <link rel="stylesheet" href="/appsocks/Public/css/cart.css">
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
                    <li><a href="/appsocks/index.php/Home/Public/login">用户登录</a></li>
                    <li><a href="/appsocks/index.php/Home/Public/registe">用户注册</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="main container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h2>购买清单</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr >
                                <th>套餐名称</th>
                                <th>套餐流量/GB</th>
                                <th>套餐时长/天</th>
                                <th>套餐费用/RMB</th>
                                <th>套餐备注</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo ($combo['title']); ?></td>
                                <td><?php echo ($combo['flow'] / 1024); ?></td>
                                <td><?php echo ($combo['duration']); ?></td>
                                <td><?php echo ($combo['cost']); ?></td>
                                <td><?php echo ($combo['remark']); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <p>小结：￥<?php echo ($combo['summary']); ?></p>
                </div>
                <form class="form" action="/appsocks/index.php/Index/pay" method="post">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nickname">昵称</label>
                                <input type="text" class="form-control" id="nickname" placeholder="张全蛋" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="password">密码</label>
                                <input type="password" class="form-control" id="password" placeholder="不少于6位数" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="password">确认密码</label>
                                <input type="password" class="form-control" id="password" placeholder="不少于6位数" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="email">邮箱</label>
                                <input type="email" class="form-control" id="email" placeholder="quandan@example.com" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-10">
                            <a href="/appsocks/index.php/Public/login">你已经有帐号？</a>
                            <button type="submit" class="btn btn-success">确认订购</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>