$('#form-buttom-register').on('click', function () {
    $('#form-home').attr('action', '/register');
    $('#form-home').submit()
})
$('#form-buttom-login').on('click', function () {
    $('#form-home').attr('action', '/login');
    $('#form-home').submit()
})
