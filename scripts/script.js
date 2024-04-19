function displayAccount() {
  console.log('Jamal Hill Sucks');
  document.getElementById('my-review-pref').classList.add('hidden');
  document.getElementById('my-account-pref').classList.remove('hidden');
  closeOffcanvas();
}

function displayRatingsReviews() {
  console.log('Jamal Hill Sucks');
  document.getElementById('my-review-pref').classList.remove('hidden');
  document.getElementById('my-account-pref').classList.add('hidden');
  closeOffcanvas();
}

function displayPassForm() {
  console.log('Jamal Hill Sucks');
  document.getElementById('password-form-change').classList.remove('hidden');
  document.getElementById('change-pass-btn').classList.add('hidden');
}

function hidePassForm() {
  console.log('Jamal Hill Sucks');
  document.getElementById('password-form-change').classList.add('hidden');
  document.getElementById('change-pass-btn').classList.remove('hidden');
}

// Function to close the offcanvas menu
function closeOffcanvas() {
  const offcanvas = document.querySelector('.offcanvas');
  const backdrop = document.querySelector('.offcanvas-backdrop');
  offcanvas.classList.remove('show');
  backdrop.classList.remove('show');
}

// Function to register User
function registerUser() {
  //alert('wOrKs'); //Call test
  var uname = document.getElementById('uname').value;
  var email = document.getElementById('email').value;
  var psswd = document.getElementById('psswd').value;
  /*if (!uname || !email || !psswd) {
    alert(psswd);
    alert("Empty String");
  }
  else {*/
  //Makes an object to send
  let formData = new FormData();

  formData.append('register_user', uname);
  formData.append('register_email', email);
  formData.append('register_password', psswd);

  fetch('../pages/register.php', {
    method: 'POST',
    body: formData,
  })
    .then((response) => response.text()) // Sends object (Will request updating to JSON for security reasons)
    .then((data) => console.log(data))
    .catch((error) => console.error('Error: ', error));
  //}
}

function loginUser() {
  //alert(''); //Call test
}

// WAIT FOR THE PAGE TO LOAD BEFORE ADDING LISTENERS
window.addEventListener('load', function () {
  document
    .getElementById('my-prof-account-opt')
    .addEventListener('click', displayAccount);

  document
    .getElementById('my-prof-rr-opt')
    .addEventListener('click', displayRatingsReviews);

  document
    .getElementById('change-pass-btn')
    .addEventListener('click', displayPassForm);

  document
    .getElementById('cancel-pass-btn')
    .addEventListener('click', hidePassForm);

  document
    .getElementById('registerModal')
    .querySelector('.creds-form-confirm')
    .addEventListener('click', registerUser);

  document
    .getElementById('signinModal')
    .querySelector('.creds-form-confirm')
    .addEventListener('click', loginUser);
});
