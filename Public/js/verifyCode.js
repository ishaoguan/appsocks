$(document).ready(function() {
    $('.validation-img').on('click', function() {
        $(this).attr('src', path + '?random='+Math.random());
    });
});
