window.onload = function() {
    $('a#edit_combo_info').each(function(event) {
        $(this).click(function() {
            var cid = $(this).data('cid');
            var modal = $('#combo-modal');
            modal.find('.modal-title').text('修改套餐');
            modal.find('#variable_btn').text('修改');
            var comboid = modal.find('#combo-id');
        	var title = modal.find('#combo-title');
            var flow = modal.find('#combo-flow');
            var duration = modal.find('#combo-duration');
            var cost = modal.find('#combo-cost');
            var remark = modal.find('#combo-remark');
            var status = modal.find('#combo-status');
            var form = modal.find('form');
            modal.find('#variable_btn').prev('button').after('<a role="button" class="btn btn-danger" href="index.php/Ajax/deleteCombo/cid/'+cid+'">删除</a>')
            $.post('index.php/Home/Ajax/getCombo', { cid: cid }, function(data, textStatus, xhr) {
                comboid.val(cid);
                title.val(data['title']);
                flow.val(data['flow'] / 1024);
                duration.val(data['duration']);
                cost.val(data['cost']);
                remark.val(data['remark']);
                status.val(data['status']);
                form.attr("action", "index.php/Home/Ajax/editCombo");
            });
        });
    });
    $('#add-combo-btn').on('click', function(event) {
        var modal = $('#combo-modal');
        modal.find('.modal-title').text('添加套餐');
        modal.find('#variable_btn').text('添加');
        modal.find('#variable_btn').prev('a').remove();
        modal.find('#combo-id').val('');
        modal.find('#combo-title').val('');
        modal.find('#combo-flow').val('');
        modal.find('#combo-duration').val('');
        modal.find('#combo-cost').val('');
        modal.find('#combo-remark').val('');
        modal.find('#combo-status').val('1');
        modal.find('form').attr("action", "index.php/Home/Ajax/addCombo");
    });
}
