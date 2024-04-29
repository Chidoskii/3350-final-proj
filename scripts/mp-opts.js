function showRateSlider() {
  const element = document.getElementByID('rate-range-can');
  if (clist.classList.contains('hideme')) {
    clist.classList.remove('hideme');
    clist.classList.add('showme');
  }
}
