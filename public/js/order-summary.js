document.addEventListener("DOMContentLoaded", () => {
    const orderSummaryDiv = document.getElementById("orderSummary");

    // Retrieve order details from localStorage
    const orderDetails = JSON.parse(localStorage.getItem("orderDetails"));

    if (orderDetails) {
        // Display the order summary dynamically
        orderSummaryDiv.innerHTML = `
            <h3>Order Type: ${orderDetails.orderType}</h3>
            <p><strong>Order Summary:</strong></p>
            <ul>
                <li><strong>Delivery Address:</strong> ${orderDetails.deliveryAddress || "N/A"}</li>
                <li><strong>House/Unit Number:</strong> ${orderDetails.houseNumber || "N/A"}</li>
                <li><strong>Delivery Date and Time:</strong> ${orderDetails.selectedDeliveryDate || "N/A"}</li>
                <li><strong>Pickup Date and Time:</strong> ${orderDetails.selectedPickupDate || "N/A"}</li>
            </ul>
            <p><strong>Total Price:</strong> ₱${orderDetails.totalPrice}</p>
            <p><strong>Orders:</strong></p>
            <ul>
                ${orderDetails.items.map(item => `
                    <li>${item.itemName} - Quantity: ${item.quantity}, Size: ${item.size}, Temperature: ${item.temperature}</li>
                `).join('')}
            </ul>
        `;
    } else {
        orderSummaryDiv.innerHTML = "<p>No order details found.</p>";
    }
});

// Optional function for Confirm Order button
function confirmOrder() {
    alert("Order confirmed!");
    // Redirect to payment page or perform other actions
    // window.location.href = "payment-page-url"; // Example of redirect to payment page
}
