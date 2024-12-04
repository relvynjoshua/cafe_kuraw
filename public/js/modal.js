// Get modal elements
const modal = document.getElementById("orderModal");
const closeBtn = document.getElementsByClassName("close-btn")[0];
const orderNowBtns = document.querySelectorAll(".order-now-btn");
const placeOrderBtn = document.getElementById("placeOrderBtn");

// Get elements inside the modal
const itemNameElement = document.getElementById("item-name");
const itemPriceElement = document.getElementById("item-price");
const itemImageElement = document.getElementById("item-image");
const quantityInput = document.getElementById("quantity");

// Open the modal and populate it with item data
orderNowBtns.forEach((btn) => {
    btn.addEventListener("click", function (e) {
        e.preventDefault(); // Prevent the default anchor link behavior

        const itemName = btn.getAttribute("data-item");
        const itemPrice = btn.getAttribute("data-price");
        const itemImage = btn.getAttribute("data-image");

        // Set modal content
        itemNameElement.textContent = itemName;
        itemPriceElement.textContent = itemPrice;
        itemImageElement.src = itemImage;

        // Open modal
        modal.style.display = "block";
    });
});

// Close the modal when the close button is clicked
closeBtn.addEventListener("click", function () {
    modal.style.display = "none";
});

// Close the modal if the user clicks anywhere outside of the modal content
window.addEventListener("click", function (e) {
    if (e.target === modal) {
        modal.style.display = "none";
    }
});

// Update quantity value
document.getElementById("increase").addEventListener("click", function () {
    quantityInput.value = parseInt(quantityInput.value) + 1;
});

document.getElementById("decrease").addEventListener("click", function () {
    if (quantityInput.value > 1) {
        quantityInput.value = parseInt(quantityInput.value) - 1;
    }
});

// Adjust quantity in the modal
function adjustQuantity(change) {
  var quantityInput = document.getElementById("quantity");
  var newQuantity = parseInt(quantityInput.value) + change;

  if (newQuantity < 1) return; // Prevent negative or zero quantity
  quantityInput.value = newQuantity;
}



// Handle "Place Order" click
placeOrderBtn.addEventListener("click", function () {
    // Create an order object
    const orderDetails = {
        itemName: itemNameElement.textContent,
        quantity: parseInt(quantityInput.value),
        price: parseFloat(itemPriceElement.textContent),
        totalPrice: parseFloat(itemPriceElement.textContent) * parseInt(quantityInput.value),
    };

    // Store the order details in sessionStorage (or localStorage if you want it persistent)
    sessionStorage.setItem("orderDetails", JSON.stringify(orderDetails));

    // Redirect to the order summary page
    window.location.href = "/order-summary"; // Adjust this to match your order summary route
});
