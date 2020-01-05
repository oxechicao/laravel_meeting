function changeFormToRegister() {
  $('#form-register-pass-confirm').removeAttr('hidden')
  $('#form-register-name').removeAttr('hidden')
  $('#form-register-name').attr('required', true)

  $('#form-buttom-register').text('Já sou cadastrado!');
  $('#form-button-login').text('Registrar');
}

function changeFormToLogin() {
  $('#form-register-pass-confirm').attr('hidden', true)
  $('#form-register-name').attr('hidden', true)
  $('#form-register-name').removeAttr('required')

  $('#form-buttom-register').text('Primeira vez? Cadastre-se!');
  $('#form-button-login').text('Entrar');
}

$('#form-buttom-register').on('click', function () {
  if ($('#form-button-login').text().trim().toString() === 'Entrar') {
    return changeFormToRegister()
  } else {
    return changeFormToLogin()
  }

});

$('#form-button-login').on('click', function () {
  if ($('#form-button-login').text().trim().toString() === 'Entrar') {
    $('#form-home').attr('action', '/login');
    $('#form-home').submit();
  } else {
    $('#form-home').attr('action', '/register');
    $('#form-home').submit();
  }
});

$('#form-home input').keypress(function (e) {
  if (e.which == 13) {
    $('#form-home').submit();
  }
})
