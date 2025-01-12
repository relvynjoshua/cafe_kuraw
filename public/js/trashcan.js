import Toastify from "toastify-js";

function markAsRead(event, notificationId, csrfToken, url) {
    event.preventDefault();

    forceRefreshNotificationBadge();
    if (!notificationId) {
        console.error("Notification ID is missing.");
        return;
    }

    // Fetch both orderId and reservationId from the notification data
    const orderId = $("#notification-" + notificationId).data("order-id");
    const reservationId = $("#notification-" + notificationId).data(
        "reservation-id"
    );

    // Log the fetched IDs for debugging
    console.log("Fetched Order ID: ", orderId);
    console.log("Fetched Reservation ID: ", reservationId);

    $.ajax({
        url: url, // URL for marking as read
        method: "POST", // Use POST
        data: {
            _token: csrfToken, // CSRF token for security
            notificationId: notificationId, // ID of the notification
        },
        success: function (response) {
            // Remove the specific notification from the dropdown
            $("#notification-" + notificationId).fadeOut("slow", function () {
                $(this).remove(); // Ensure the item is removed from DOM after fade out
                forceRefreshNotificationBadge(); // Forcefully refresh the badge after DOM changes
            });

            // Show toast notification
            Toastify({
                text: "New Notification Received!",
                duration: 3000,
                close: true,
                gravity: "top", // top or bottom
                position: "right", // left, center, right
                backgroundColor: "#4CAF50", // Green color for success
            }).showToast();

            // Check if it's an order notification
            if (orderId) {
                // Fetch order details
                $.ajax({
                    url: `/orders/${orderId}`, // Correct the route to match your controller
                    method: "GET",
                    success: function (orderData) {
                        // Populate the modal with order data
                        $("#modalCustomerName").text(orderData.customerName);
                        $("#modalOrderDate").text(orderData.date);
                        $("#modalOrderStatus").text(orderData.status);
                        let modalProducts = $("#modalProducts");
                        modalProducts.empty(); // Clear previous data

                        orderData.products.forEach((product) => {
                            modalProducts.append(`
                                <tr>
                                    <td>${product.name}</td>
                                    <td>${product.variation}</td>
                                    <td>${product.quantity}</td>
                                    <td>${product.price}</td>
                                    <td>${product.total}</td>
                                </tr>
                            `);
                        });

                        // Show the modal
                        $("#orderDetailsModal").modal("show");
                    },
                    error: function () {
                        alert("Error fetching order details!");
                    },
                });
            }
        },
        error: function (xhr, status, error) {
            console.error("Error marking notification as read", error);
            alert("Failed to mark notification as read!");
        },
    });
}

// Function to force refresh the notification badge
function forceRefreshNotificationBadge() {
    var unreadNotificationsCount = $(
        "#notification-list .notification-item"
    ).length;

    if (unreadNotificationsCount > 0) {
        $("#notification-badge").text(unreadNotificationsCount).show();

        // Show a toast when new notifications appear
        Toastify({
            text: "You have new notifications!",
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            backgroundColor: "#FF5722", // Red color for new notifications
        }).showToast();
    } else {
        $("#notification-badge").hide();
    }
}

// Function to mark all notifications as read and force refresh
function markAllAndRedirect(event) {
    event.preventDefault();

    // Send AJAX request to mark all notifications as read
    $.ajax({
        url: $("#mark-all-read-form").attr("action"), // Use the form's action URL
        method: "POST",
        data: $("#mark-all-read-form").serialize(), // Serialize the CSRF token
        success: function (response) {
            // Simulate marking all notifications as read by clearing the list
            $("#notification-list .notification-item").fadeOut(
                "slow",
                function () {
                    $(this).remove(); // Remove all items from the dropdown
                    forceRefreshNotificationBadge(); // Forcefully refresh the badge after clearing
                }
            );
        },
        error: function () {
            alert("Failed to mark all notifications as read!");
        },
    });
}
function fetchOrderDetails(orderId) {
    $.ajax({
        url: `/orders/${orderId}`, // Correct URL for fetching order details
        method: "GET",
        success: function (orderData) {
            // Update modal content with fetched order data
            $("#modalOrderStatus").text(orderData.status);
            $("#modalOrderDate").text(orderData.created_at); // Assuming 'created_at' holds the date

            let modalProducts = $("#modalProducts");
            modalProducts.empty(); // Clear any previous data

            // Populate table rows with product details
            orderData.products.forEach(function (product) {
                modalProducts.append(`
                    <tr>
                        <td>${product.name}</td>
                        <td>${product.variation}</td>
                        <td>${product.quantity}</td>
                        <td>${product.price}</td>
                        <td>${product.total}</td>
                    </tr>
                `);
            });

            // Open the modal
            $("#orderDetailsModal").modal("show");
        },
    });
}
