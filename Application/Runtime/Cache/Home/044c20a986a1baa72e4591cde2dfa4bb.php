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
    <link rel="stylesheet" href="/appsocks/Public/css/nodeManage.css">
</head>
<body>
    <div class="info">
            <span>节点管理</span>
            <button class="btn btn-success add-node">添加</button>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>节点名称</th>
                <th>服务器地址</th>
                <th>加密方式</th>
                <th>所属套餐</th>
                <th>备注说明</th>
                <th>是否可用</th>
            </tr>
        </thead>
        <tbody>
            <?php if(is_array($node_data)): $i = 0; $__LIST__ = $node_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$node): $mod = ($i % 2 );++$i;?><td><?php echo ($node["nid"]); ?></td>
                <td><?php echo ($node["name"]); ?></td>
                <td><?php echo ($node["server"]); ?></td>
                <td><?php echo ($node["method"]); ?></td>
                <td><?php echo ($node["combo"]); ?></td>
                <td><?php echo ($node["remark"]); ?></td>
                <td><?php echo $node['status'] == 1 ? '可用' : '不可用';?></td><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>

</body>
</html>