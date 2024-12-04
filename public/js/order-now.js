function placeOrder() {
    // Get item details from the modal
    var itemName = "Espresso"; // This should be dynamically set based on the button clicked
    var price = 80; // This should be dynamically set
    var quantity = parseInt(document.getElementById("quantity").value);

    // Create order object
    const orderDetails = {
        itemName: itemName,
        price: price,
        quantity: quantity,
        totalPrice: price * quantity
    };

    // Store the order details in localStorage (or sessionStorage)
    localStorage.setItem("orderDetails", JSON.stringify(orderDetails));

    // Redirect to the Order Summary page
    window.location.href = "/order-summary"; // Ensure this route exists
}
