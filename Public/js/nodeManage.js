$(document).ready(function() {
    $('.node-status').change(function () {
      var nid = $(this).data('nid');
      var status = $(this).children('option:selected').val();
      var selection = $(this);
      $.post("./../Ajax/editNodeStatus",{nid:nid, status:status},function(result){
        // selection.val(result);
        console.log(result);
      });
    });
});
