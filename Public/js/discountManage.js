$(document).ready(function() {
    $('.discount-status').change(function() {
        var did = $(this).data('did');
        var status = $(this).children('option:selected').val();
        var selection = $(this);
        console.log(did);
        $.post(url, {
            did: did,
            status: status
        }, function(result) {
            console.log(result);
        });
    });
});
