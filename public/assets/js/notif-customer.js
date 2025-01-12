// Modify markAsRead to disable badge refresh temporarily
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

    console.log("Fetched Order ID: ", orderId);
    console.log("Fetched Reservation ID: ", reservationId);

    $.ajax({
        url: `/notifications/${notificationId}/mark-read`,
        method: "POST",
        data: {
            _token: csrfToken,
            notificationId: notificationId,
        },
        success: function (response) {
            // Show success message using Toastify
            Toastify({
                text: "Notification marked as read!",
                duration: 15000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#f4e8c1", // Soft beige for light notifications
                stopOnFocus: true,
                style: {
                    border: "1px solid #d3ad6e", // Thin gold border for elegance
                    borderRadius: "12px", // Softer rounded corners
                    padding: "12px", // Balanced padding
                    boxShadow: "0px 4px 6px rgba(0, 0, 0, 0.1)", // Subtle shadow for depth
                    fontSize: "14px", // Consistent font size
                    color: "#222222", // Dark text for readability
                },
            }).showToast();

            // Fade out and remove the notification item from the list
            $("#notification-" + notificationId).fadeOut("slow", function () {
                $(this).remove();
                // Re-enable badge refresh after updating the list
                isBadgeRefreshDisabled = false;
                forceRefreshNotificationBadge();
            });

            // Manually decrement the unread notification count
            var unreadCount = parseInt($("#notification-badge").text()) || 0;
            unreadCount = Math.max(unreadCount - 1, 0); // Ensure it doesn't go below 0
            $("#notification-badge").text(unreadCount);

            // Hide badge if no unread notifications remain
            if (unreadCount === 0) {
                $("#notification-badge").hide();
            }

            // Fetch order details if the notification is related to an order
            if (orderId) {
                console.log(
                    "Fetched Order ID THIS IS ALREADY IN AJAX: ",
                    orderId
                );
                console.log("Order details response:", response);

                $.ajax({
                    url: `/order/${orderId}/details`, // This should be correct if you are passing the order ID properly
                    method: "GET",
                    success: function (response) {
                        if (response.success && response.order) {
                            let orderData = response.order; // Get the order object

                            // Populate the modal with order data
                            $("#modalCustomerName").text(
                                orderData.customerName
                            );
                            $("#modalOrderDate").text(orderData.date);
                            $("#modalOrderStatus").text(orderData.status);
                            let modalProducts = $("#modalProducts");
                            modalProducts.empty(); // Clear previous data

                            // Append the products to the modal
                            if (
                                orderData.products &&
                                Array.isArray(orderData.products)
                            ) {
                                orderData.products.forEach((product) => {
                                    modalProducts.append(`
                                    <tr>
                                    <td>${product.name}</td>
                                    <td>${product.pivot.variation}</td>
                                    <td>${product.pivot.quantity}</td>
                                    <td>${product.price}</td>
                                    <td>${product.total}</td> 
                                 </tr>
                                    `);
                                });
                            } else {
                                console.error(
                                    "Products array is malformed or missing"
                                );
                            }

                            // Show the order details modal
                            $("#orderDetailsModal").modal("show");
                        } else {
                            console.error(
                                "Error: Order not found or malformed"
                            );
                            alert("Order details not found!");
                        }
                    },
                    error: function () {
                        alert("Error fetching order details!");
                    },
                });
            }
            // Fetch reservation details if the notification is related to a reservation
            else if (reservationId) {
                $.ajax({
                    url: `/reservations/${reservationId}`, // Correct route for reservations
                    method: "GET",
                    success: function (reservationData) {
                        let modalReservationDetails = $(
                            "#modalReservationDetails"
                        );
                        modalReservationDetails.empty(); // Clear previous data

                        // Append the reservation data to the modal
                        modalReservationDetails.append(`
                            <tr>
                                <td>${reservationData.name}</td>
                                <td>${reservationData.reservation_date}</td>
                                <td>${reservationData.reservation_time}</td>
                                <td>${reservationData.number_of_guests}</td>
                                <td>${reservationData.status}</td>
                            </tr>
                        `);

                        // Optionally, you can add additional fields like email, phone, and note
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

                        // Show the reservation details modal
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
            // Re-enable badge refresh in case of error
            isBadgeRefreshDisabled = false;
            forceRefreshNotificationBadge();
        },
    });
}

// Global flag to control badge refresh behavior
let isBadgeRefreshDisabled = false;
var previousUnreadNotificationsCount = 0;
var isUnreadToastShown = false; // Flag to track if the unread count toast has been shown

$(document).ready(function () {
    setInterval(forceRefreshNotificationBadge, 500);
});

// Modify forceRefreshNotificationBadge to check the flag
function forceRefreshNotificationBadge() {
    console.log("Force");
    if (isBadgeRefreshDisabled) {
        return; // Skip the badge refresh if disabled
    }

    var unreadNotificationsCount = $(
        "#notification-list .notification-item"
    ).length;

    if (unreadNotificationsCount > 0) {
        $("#notification-badge").text(unreadNotificationsCount).show();

        // Show toast if unread count is greater than the previous count
        if (unreadNotificationsCount > previousUnreadNotificationsCount) {
            toastNotifyNew(); // Call toast function when count increases
        }

        // Show toast for unread notifications only once
        if (!isUnreadToastShown) {
            toastNotifyUnreadCount(unreadNotificationsCount);
            isUnreadToastShown = true; // Set the flag to true after showing the toast
        }
    } else {
        // Set badge text to "0" and ensure it remains visible
        $("#notification-badge").text("0").show();
        isUnreadToastShown = false; // Reset the flag when there are no unread notifications
    }

    previousUnreadNotificationsCount = unreadNotificationsCount; // Update the previous count
}

function toastNotifyNew() {
    Toastify({
        text: "There is a new notification!",
        duration: 15000,
        close: true,
        gravity: "top",
        position: "right",
        backgroundColor: "#fff8e1", // Softer yellowish beige
        stopOnFocus: true,
        style: {
            border: "1px solid #d3ad6e", // Gold border for subtle contrast
            borderRadius: "12px", // Softer rounded corners
            padding: "12px", // Balanced padding
            boxShadow: "0px 4px 6px rgba(0, 0, 0, 0.1)", // Subtle shadow for depth
            fontSize: "14px", // Consistent font size
            color: "#222222", // Dark text for readability
        },
    }).showToast();
}

function toastNotifyUnreadCount(unreadNotificationsCount) {
    Toastify({
        text: `You have ${unreadNotificationsCount} unread notifications.`,
        duration: 15000,
        close: true,
        gravity: "top",
        position: "right",
        backgroundColor: "#f4f4f4", // Light gray for a modern tone
        stopOnFocus: true,
        style: {
            border: "1px solid #222222", // Dark border for contrast
            borderRadius: "12px", // Softer rounded corners
            padding: "12px", // Balanced padding
            boxShadow: "0px 4px 6px rgba(0, 0, 0, 0.1)", // Subtle shadow for depth
            fontSize: "14px", // Consistent font size
            color: "#222222", // Dark text for readability
        },
    }).showToast();
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
           // Show toast for marking all notifications as read
            Toastify({
                text: "All notifications marked as read.",
                duration: 10000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#e8e8e8", // Neutral light gray
                stopOnFocus: true,
                style: {
                    border: "1px solid #b5b5b5", // Subtle gray border
                    borderRadius: "12px", // Softer rounded corners
                    padding: "12px", // Balanced padding
                    boxShadow: "0px 4px 6px rgba(0, 0, 0, 0.1)", // Subtle shadow for depth
                    fontSize: "14px", // Consistent font size
                    color: "#222222", // Dark text for readability
                },
            }).showToast();
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
