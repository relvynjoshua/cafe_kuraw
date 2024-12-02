document.addEventListener("DOMContentLoaded", () => {
    const orderSummaryDiv = document.getElementById("orderSummary");

    // Retrieve order details from sessionStorage
    const orderDetails = JSON.parse(sessionStorage.getItem("orderDetails"));

    if (orderDetails) {
        // Display the order summary
        orderSummaryDiv.innerHTML = `
            <h3>Order Type: ${orderDetails.orderType}</h3>
            <p><strong>Order Summary:</strong></p>
            <ul>
                <li><strong>Delivery Address:</strong> ${orderDetails.deliveryAddress || "N/A"}</li>
                <li><strong>House/Unit Number:</strong> ${orderDetails.houseNumber || "N/A"}</li>
                <li><strong>Delivery Date and Time:</strong> ${orderDetails.selectedDeliveryDate || "N/A"}</li>
                <li><strong>Pickup Date and Time:</strong> ${orderDetails.selectedPickupDate || "N/A"}</li>
            </ul>
            <p><strong>Total Price:</strong> $XX.XX</p>
            <p><strong>Orders:</strong></p>
            <ul>
                <li>Espresso - Quantity: 1, Size: Medium, Temperature: Hot</li>
                <li>Cafe Americano - Quantity: 2, Size: Large, Temperature: Iced</li>
            </ul>
        `;
    } else {
        orderSummaryDiv.innerHTML = "<p>No order details found.</p>";
    }
});
