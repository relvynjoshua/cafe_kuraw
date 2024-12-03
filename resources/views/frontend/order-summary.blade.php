@extends('layouts.app')

@section('title', 'Order Summary')

@section('content')
<div class="order-summary-container">
    <h1 class="order-summary-title">Order Summary</h1>

    <div id="orderSummary">
        <!-- Order details will be populated dynamically here via JavaScript -->
    </div>

    <!-- Optional: A button to confirm the order -->
    <button class="confirm-order-btn" onclick="confirmOrder()">Confirm Order</button>
</div>

<!-- Include your custom JS file for order summary -->
<script>
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
                <p><strong>Items:</strong></p>
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

    // Function to handle order confirmation
    function confirmOrder() {
        // Clear the order details from localStorage (optional)
        localStorage.removeItem("orderDetails");

        // Redirect to a confirmation page or back to menu
        window.location.href = "/menu";  // Adjust this URL as needed
    }
</script>
@endsection
