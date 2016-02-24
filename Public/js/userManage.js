window.onload = function(){
	$('#check_user_order').on('shown.bs.modal', function () {
		var uid = $(this).data('uid');
		var bill = '<table class="table table-bordered"><thead><tr><th>订单号</th><th>套餐名</th><th>开通时间</th><th>到期时间</th><th>费用</th><th>是否成功</th></tr></thead><tbody>';
		$.post('/index.php/Home/Ajax/getPersonOrderRecord', {uid : uid}, function(data, textStatus, xhr) {
			for (var i = 0; i < data.length; i++) {
				bill += '<tr><td>' + data[i]['oid'] + '</td>' +
				'<td>' + data[i]['title'] + '</td>' +
				'<td>' + data[i]['purchase_time'] + '</td>' +
				'<td>' + data[i]['expire_time'] + '</td>' +
				'<td>' + data[i]['cost'] + 'RMB</td>' +
				'<td>' + ((data[i]['success'] == 1)? '成功' : '失败') + '</td></tr>';
			}
			bill += '</tbody></table>';
			$('.modal-body').html(bill);
		});
	});
}
