function displayAccount() {
  console.log('Jamal Sucks');
  document.getElementById('my-review-pref').classList.add('hidden');
  document.getElementById('my-account-pref').classList.remove('hidden');
  closeOffcanvas();
}

function displayRatingsReviews() {
  console.log('Jamal Sucks');
  document.getElementById('my-review-pref').classList.remove('hidden');
  document.getElementById('my-account-pref').classList.add('hidden');
  closeOffcanvas();
}

function displayPassForm() {
  console.log('Jamal Sucks');
  document.getElementById('password-form-change').classList.remove('hidden');
  document.getElementById('change-pass-btn').classList.add('hidden');
}

function hidePassForm() {
  console.log('Jamal Sucks');
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
});
