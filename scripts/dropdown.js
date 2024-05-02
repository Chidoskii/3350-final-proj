document.addEventListener('DOMContentLoaded', (event) => {
  const dropdownItems = document.querySelectorAll('.dropdown-item');

  dropdownItems.forEach(item => {
    item.addEventListener('click', function(event) {
      event.preventDefault();
      event.stopPropagation();
      
      const selectedItemText = this.textContent;

      console.log('Selected item:', selectedItemText);
      
      let data = new FormData();
      data.append('dropdowndata',selectedItemText);

      fetch('php/functions.php', {
      method: "POST",
      body: data,
    })
      .then((response) => response.text()) // Sends object
      .then((data) => console.log(data))
      .catch((error) => console.error('Error: ', error));
    });
  });
});