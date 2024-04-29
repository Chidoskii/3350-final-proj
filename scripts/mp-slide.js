const initSlider = () => {
  const imageList = document.querySelector('.slider-wrapper .credits-list');
  const newImageList = document.querySelector(
    '.slider-wrapper .new-r-image-list'
  );
  const slideButtons = document.querySelectorAll(
    '.slider-wrapper .slide-button'
  );
  const newslideButtons = document.querySelectorAll(
    '.slider-wrapper .nr-slide-button'
  );
  const sliderScrollbar = document.querySelector(
    '.reel-container .slider-scrollbar'
  );
  const newsliderScrollbar = document.querySelector(
    '.reel-container .nr-slider-scrollbar'
  );
  const scrollbarThumb = sliderScrollbar.querySelector('.scrollbar-thumb');
  const maxScrollLeft = imageList.scrollWidth - imageList.clientWidth;
  const newscrollbarThumb = newsliderScrollbar.querySelector(
    '.nr-scrollbar-thumb'
  );
  const newmaxScrollLeft = newImageList.scrollWidth - newImageList.clientWidth;

  // Handle scrollbar thumb drag
  scrollbarThumb.addEventListener('mousedown', (e) => {
    const startX = e.clientX;
    const thumbPosition = scrollbarThumb.offsetLeft;
    const maxThumbPosition =
      sliderScrollbar.getBoundingClientRect().width -
      scrollbarThumb.offsetWidth;

    // Update thumb position on mouse move
    const handleMouseMove = (e) => {
      const deltaX = e.clientX - startX;
      const newThumbPosition = thumbPosition + deltaX;
      // Ensure the scrollbar thumb stays within bounds
      const boundedPosition = Math.max(
        0,
        Math.min(maxThumbPosition, newThumbPosition)
      );
      const scrollPosition =
        (boundedPosition / maxThumbPosition) * maxScrollLeft;

      scrollbarThumb.style.left = `${boundedPosition}px`;
      imageList.scrollLeft = scrollPosition;
    };
    // Remove event listeners on mouse up
    const handleMouseUp = () => {
      document.removeEventListener('mousemove', handleMouseMove);
      document.removeEventListener('mouseup', handleMouseUp);
    };
    // Add event listeners for drag interaction
    document.addEventListener('mousemove', handleMouseMove);
    document.addEventListener('mouseup', handleMouseUp);
  });
  // Slide images according to the slide button clicks
  slideButtons.forEach((button) => {
    button.addEventListener('click', () => {
      const direction = button.id === 'prev-slide' ? -1 : 1;
      const scrollAmount = imageList.clientWidth * direction;
      imageList.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    });
  });
  // Show or hide slide buttons based on scroll position
  const handleSlideButtons = () => {
    slideButtons[0].style.display = imageList.scrollLeft <= 0 ? 'none' : 'flex';
    slideButtons[1].style.display =
      imageList.scrollLeft >= maxScrollLeft ? 'none' : 'flex';
  };
  // Update scrollbar thumb position based on image scroll
  const updateScrollThumbPosition = () => {
    const scrollPosition = imageList.scrollLeft;
    const thumbPosition =
      (scrollPosition / maxScrollLeft) *
      (sliderScrollbar.clientWidth - scrollbarThumb.offsetWidth);
    scrollbarThumb.style.left = `${thumbPosition}px`;
  };
  // Call these two functions when image list scrolls
  imageList.addEventListener('scroll', () => {
    updateScrollThumbPosition();
    handleSlideButtons();
  });

  // Handle scrollbar thumb drag
  newscrollbarThumb.addEventListener('mousedown', (e) => {
    const startX = e.clientX;
    const thumbPosition = newscrollbarThumb.offsetLeft;
    const maxThumbPosition =
      newsliderScrollbar.getBoundingClientRect().width -
      newscrollbarThumb.offsetWidth;

    // Update thumb position on mouse move
    const handleMouseMove = (e) => {
      const deltaX = e.clientX - startX;
      const newThumbPosition = thumbPosition + deltaX;
      // Ensure the scrollbar thumb stays within bounds
      const boundedPosition = Math.max(
        0,
        Math.min(maxThumbPosition, newThumbPosition)
      );
      const scrollPosition =
        (boundedPosition / maxThumbPosition) * newmaxScrollLeft;

      newscrollbarThumb.style.left = `${boundedPosition}px`;
      newImageList.scrollLeft = scrollPosition;
    };
    // Remove event listeners on mouse up
    const handleMouseUp = () => {
      document.removeEventListener('mousemove', handleMouseMove);
      document.removeEventListener('mouseup', handleMouseUp);
    };
    // Add event listeners for drag interaction
    document.addEventListener('mousemove', handleMouseMove);
    document.addEventListener('mouseup', handleMouseUp);
  });
  // Slide images according to the slide button clicks
  newslideButtons.forEach((button) => {
    button.addEventListener('click', () => {
      const direction = button.id === 'new-prev-slide' ? -1 : 1;
      const scrollAmount = newImageList.clientWidth * direction;
      newImageList.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    });
  });
  // Show or hide slide buttons based on scroll position
  const handleNewSlideButtons = () => {
    newslideButtons[0].style.display =
      newImageList.scrollLeft <= 0 ? 'none' : 'flex';
    newslideButtons[1].style.display =
      newImageList.scrollLeft >= newmaxScrollLeft ? 'none' : 'flex';
  };
  // Update scrollbar thumb position based on image scroll
  const updateNewScrollThumbPosition = () => {
    const scrollPosition = newImageList.scrollLeft;
    const thumbPosition =
      (scrollPosition / newmaxScrollLeft) *
      (sliderScrollbar.clientWidth - newscrollbarThumb.offsetWidth);
    newscrollbarThumb.style.left = `${thumbPosition}px`;
  };
  // Call these two functions when image list scrolls
  newImageList.addEventListener('scroll', () => {
    updateNewScrollThumbPosition();
    handleNewSlideButtons();
  });
};

function showRateSlider() {
  const element = document.getElementById('rate-range-can');
  if (element.classList.contains('hideme')) {
    element.classList.remove('hideme');
    element.classList.add('showme');
  } else {
    element.classList.remove('showme');
    element.classList.add('hideme');
  }
}

window.addEventListener('resize', initSlider);
window.addEventListener('load', initSlider);
