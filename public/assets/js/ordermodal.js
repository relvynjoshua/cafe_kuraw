// Get modal element and buttons
const orderModal = document.getElementById('orderModal');
const orderButtons = document.querySelectorAll('.order-now-btn');
const closeBtn = document.querySelector('.close-btn');
const quantityInput = document.querySelector('.quantity-input');
const quantityBtns = document.querySelectorAll('.quantity-btn');
const optionGroups = document.querySelectorAll('.option-group');

// Show modal when "ORDER NOW" is clicked
orderButtons.forEach(button => {
  button.addEventListener('click', () => {
    orderModal.style.display = 'block';
  });
});

// Hide modal when "X" button is clicked
closeBtn.onclick = function() {
  orderModal.style.display = 'none';
}

// Hide modal when clicking outside the modal content
window.onclick = function(event) {
  if (event.target == orderModal) {
    orderModal.style.display = 'none';
  }
}

// Quantity control functionality
quantityBtns.forEach(btn => {
  btn.addEventListener('click', function() {
    let currentValue = parseInt(quantityInput.value);
    if (this.textContent === '+' && currentValue < 10) {
      quantityInput.value = currentValue + 1;
    } else if (this.textContent === '−' && currentValue > 1) {
      quantityInput.value = currentValue - 1;
    }
  });
});

// Toggle active state on option buttons
optionGroups.forEach(group => {
  const buttons = group.querySelectorAll('.option-btn');
  
  buttons.forEach(button => {
    button.addEventListener('click', () => {
      // If the button is already active, deactivate it
      if (button.classList.contains('active')) {
        button.classList.remove('active');
      } else {
        // Remove active class from all buttons in the group
        buttons.forEach(btn => btn.classList.remove('active'));
        
        // Activate the clicked button
        button.classList.add('active');
      }
    });
  });
});
