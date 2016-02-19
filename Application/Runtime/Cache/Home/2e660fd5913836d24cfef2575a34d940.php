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
    <link rel="stylesheet" href="/appsocks/Public/css/userManage.css">
</head>
<body>
    <div class="info">
        <span>用户管理</span>
        <button class="btn btn-success add-user">添加</button>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>用户昵称</th>
                <th>邮箱</th>
                <th>邀请人数</th>
                <th>是否激活</th>
                <th>最近一次在线时间</th>
                <th>最后一次登录IP</th>
            </tr>
        </thead>
        <tbody>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><td><?php echo ($user["uid"]); ?></td>
                <td><a id="check_user_order" role="button" data-toggle="modal" data-target="#user_info_modal" data-uid="<?php echo ($user["uid"]); ?>"><?php echo ($user["nickname"]); ?></a></td>
                <td><?php echo ($user["email"]); ?></td>
                <td><?php echo ($user["invite"]); ?></td>
                <td><?php echo $user['actived'] == 1 ? '已激活' : '未激活';?></td>
                <td><?php echo ($user["last_login_time"]); ?></td>
                <td><?php echo ($user["last_login_ip"]); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <?php echo ($page); ?>
</body>

<!-- Modal -->
<div class="modal fade" id="user_info_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">最近账单</h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger">修改用户信息</button>
                <button type="button" class="btn btn-info" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/appsocks/Public/js/userManage.js"></script>
</html>