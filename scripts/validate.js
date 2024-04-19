function validateForm() {
  let valid_form = true;

  let email = null;
  let password = null;

  let form = document.forms['login-modal'];
  email = form.elements['email'].value;
  password = form.elements['psswd'].value;
  let x = email.match(/[@]/g);
  let y = email.match(/[.]/g);

  if (password == null || password == '') {
    document.getElementById('psswd').classList.add('error');
    valid_form = false;
  } else {
    document.getElementById('psswd').classList.remove('error');
  }

  if (x == null || y == null) {
    document.getElementById('email').classList.add('error');
    valid_form = false;
  } else {
    document.getElementById('email').classList.remove('error');
  }

  return valid_form;
}

/*
window.addEventListener('load', function () {
  document
    .getElementById('contactForm')
    .addEventListener('submit', validateForm);
});
*/
