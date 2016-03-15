$(document).ready(function() {
  $('.combo-status').change(function() {
    var cid = $(this).data('cid');
    var status = $(this).children('option:selected').val();
    var selection = $(this);
    $.post("./../Ajax/editComboStatus", { cid: cid,status: status}, function(result) {
        console.log(result);
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
    modal.find('form').attr("action", "./../Ajax/addCombo");
  });
});
