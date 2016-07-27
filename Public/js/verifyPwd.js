$(document).ready(function(){
  $('#re-password').blur(function() {
    if ($(this).val() !== $('#password').val()) {
      alert('两次密码不相同');
    }
  });
});
