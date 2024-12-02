document.addEventListener("DOMContentLoaded", function () {
    // Select all proceed buttons
    document.querySelectorAll('.proceed-btn').forEach(button => {
        button.addEventListener("click", function () {
            // Get the order details
            const orderDetails = {
                itemName: itemName,
                quantity: parseInt(document.getElementById("quantity").value),
                size: document.getElementById("size").value,
                temperature: document.getElementById("temperature").value,
                totalPrice: parseFloat(document.getElementById("total-price").textContent),
                orderType: deliveryForm.style.display === "block" ? "Delivery" : "Pick-Up"
            };

            // Store the order details in local storage
            localStorage.setItem("orderDetails", JSON.stringify(orderDetails));

            // Redirect to the order summary page
            window.location.href = "order-summary.html";
        });
    });
});
