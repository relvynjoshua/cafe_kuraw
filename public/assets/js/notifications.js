$(document).ready(function () {
    // Get the notification bell icon and dropdown menu
    const notificationIcon = document.querySelector(".header-notification");
    const dropdownMenu = document.querySelector(".dropdown-menu");

    // Add event listener for clicking the notification icon
    notificationIcon.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent the default action of the link
        dropdownMenu.classList.toggle("show"); // Toggle the dropdown visibility
    });

    // Add event listener for clicking outside the dropdown to close it
    document.addEventListener("click", function (event) {
        if (
            !notificationIcon.contains(event.target) &&
            !dropdownMenu.contains(event.target)
        ) {
            dropdownMenu.classList.remove("show"); // Close the dropdown if clicked outside
        }
    });

    // Function to mark all notifications as read
    function markAllRead(event) {
        event.preventDefault();

        // Perform the AJAX request to mark all notifications as read
        $.ajax({
            url: "/notifications/mark-all-read", // Make sure this route is correct
            method: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"), // CSRF token
            },
            success: function (response) {
                // Log the success
                console.log("Notifications marked as read:", response);

                // Reset the notification badge to 0 and hide it if no unread notifications
                const notificationBadge =
                    document.getElementById("notification-badge");
                if (response.notification_count === 0) {
                    notificationBadge.textContent = "0"; // Set to 0
                    notificationBadge.style.display = "none"; // Hide the badge
                } else {
                    notificationBadge.textContent = response.notification_count; // Update the badge
                    notificationBadge.style.display = "inline-block"; // Ensure the badge is visible
                }

                // Optionally, remove unread notifications from the dropdown
                $(".notification-item").remove(); // Remove items from the dropdown
                if ($(".notification-item").length === 0) {
                    $("#notificationDropdown").append(
                        '<p class="dropdown-item text-center">No new notifications</p>'
                    );
                }
            },
            error: function (xhr) {
                console.error(
                    "Error marking notifications as read:",
                    xhr.responseText
                );
            },
        });
    }

    // Bind the "Mark All Read" button to the markAllRead function
    $("#mark-all-read-btn").on("click", function () {
        console.log("Mark All Read button clicked");
        markAllRead(); // Call function to mark all notifications as read
    });

    // Update notification count if it reaches zero
    function updateNotificationBadge() {
        const unreadCount = $("#notification-badge").text();
        console.log("Unread notification count:", unreadCount);

        if (unreadCount === "0") {
            $("#notification-badge").hide(); // Hide badge if no unread notifications
            console.log("Hiding notification badge");
        }
    }

    // When the notification icon is clicked, update the badge
    $("#notificationDropdown").on("click", function () {
        updateNotificationBadge();
    });
});
