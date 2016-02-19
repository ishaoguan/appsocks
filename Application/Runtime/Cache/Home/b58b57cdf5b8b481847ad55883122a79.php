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
    <link rel="stylesheet" href="/appsocks/Public/css/statistics.css">
</head>
<body>
    <div class="panel panel-info">
        <div class="panel-heading">统计信息</div>
        <div class="panel-body">
            <p>注册用户总数：<?php echo ($statistics_data['user_sign']); ?> 人</p>
            <p>已激活用户数：<?php echo ($statistics_data['user_active']); ?> 人</p>
            <p>共产生流量：<?php echo ($statistics_data['flow_used']); ?> M</p>
        </div>
    </div>
</body>
</html>