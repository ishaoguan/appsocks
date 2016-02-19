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
    <link rel="stylesheet" href="/appsocks/Public/css/comboManage.css">
</head>
<body>
        <div class="info">
            <span>套餐管理</span>
            <button type="button" id="add-combo-btn" class="btn btn-success add-combo" data-toggle="modal" data-target="#combo-modal">添加</button>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>套餐名称</th>
                    <th>套餐流量</th>
                    <th>套餐时长</th>
                    <th>套餐费用</th>
                    <th>备注说明</th>
                    <th>是否可用</th>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($combo_data)): $i = 0; $__LIST__ = $combo_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$combo): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($combo["cid"]); ?></td>
                        <td><a id="edit_combo_info" role="button" data-toggle="modal" data-target="#combo-modal" data-cid="<?php echo ($combo["cid"]); ?>"><?php echo ($combo["title"]); ?></a></td>
                        <td><?php echo ($combo['flow'] / 1024); ?> G</td>
                        <td><?php echo ($combo["duration"]); ?> 天</td>
                        <td><?php echo ($combo["cost"]); ?> RMB</td>
                        <td><?php echo ($combo["remark"]); ?></td>
                        <td><?php echo $combo['status'] == 1 ? '可用' : '不可用';?></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
</body>
<!-- Modal -->
<div class="modal fade" id="combo-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" action="<?php echo U('Home/Ajax/addCombo');?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">添加套餐</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="cid" value="" id="combo-id">
                    <div class="form-group">
                        <label for="combo-title" class="col-sm-3 control-label">套餐名称</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="combo_title" id="combo-title" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="combo-flow" class="col-sm-3 control-label">套餐流量/GB</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="combo_flow" id="combo-flow" min="0" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="combo-duration" class="col-sm-3 control-label">套餐时长/天</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="combo_duration" id="combo-duration" min="0" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="combo-cost" class="col-sm-3 control-label">套餐费用/RMB</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="combo_cost" id="combo-cost" min="0" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="combo-remark" class="col-sm-3 control-label">备注说明</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="combo_remark" id="combo-remark">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">是否启用</label>
                        <div class="col-sm-9">
                            <select name="combo_status" id="combo-status">
                                <option value="1" selected="selected">启用</option>
                                <option value="0">停用</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="submit" id="variable_btn" class="btn btn-primary">添加</button>
                </div>
            </form>

        </div>
    </div>
</div>
<script type="text/javascript" src="/appsocks/Public/js/comboManage.js"></script>
</html>