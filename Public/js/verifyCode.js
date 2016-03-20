$(document).ready(function() {
    var validation_path = '/appsocks/Public/verifyCode';
    $('.validation-img').on('click', function() {
        $(this).attr('src', validation_path + '/random='+Math.random());
    });
});
