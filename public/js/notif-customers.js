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

            // Check if it's a reservation notification
            else if (reservationId) {
                // Fetch reservation details
                $.ajax({
                    url: `/reservations/${reservationId}`, // Correct the route to match your controller
                    method: "GET",
                    success: function (reservationData) {
                        // Populate the modal with reservation data
                        let modalReservationDetails = $(
                            "#modalReservationDetails"
                        );
                        modalReservationDetails.empty(); // Clear previous data

                        modalReservationDetails.append(`
                            <tr>
                                <td>${reservationData.name}</td>
                                <td>${reservationData.reservation_date}</td>
                                <td>${reservationData.reservation_time}</td>
                                <td>${reservationData.number_of_guests}</td>
                                <td>${reservationData.status}</td>
                            </tr>
                        `);

                        // Optionally, you can add additional data, such as note and email, as separate fields.
                        modalReservationDetails.append(`
                            <tr>
                                <td colspan="5"><strong>Email:</strong> ${reservationData.email}</td>
                            </tr>
                            <tr>
                                <td colspan="5"><strong>Phone:</strong> ${reservationData.phone_number}</td>
                            </tr>
                            <tr>
                                <td colspan="5"><strong>Note:</strong> ${reservationData.note}</td>
                            </tr>
                        `);

                        // Show the modal
                        $("#reservationDetailsModal").modal("show");
                    },
                    error: function () {
                        alert("Error fetching reservation details!");
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
    // Recalculate the number of unread notifications based on dropdown items
    var unreadNotificationsCount = $(
        "#notification-list .notification-item"
    ).length;

    if (unreadNotificationsCount > 0) {
        // Update the badge with the new count and ensure it is visible
        $("#notification-badge").text(unreadNotificationsCount).show();
    } else {
        // Hide the badge if there are no unread notifications
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
