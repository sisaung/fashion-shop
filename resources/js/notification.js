import renderNotificationList from "./notification/renderNotificationList";
import fetchNotification from "./services/fetchNotification";
import markAsReadAllNoti from "./services/markAsReadAllNoti";
import markAsReadNoti from "./services/markAsReadNoti";
import getStatusBadge from "./utils/getStatusBadge";
import numberFormat from "./utils/numberFormat";
import timeStep from "./utils/timeStep";

const initializeNotification = async () => {
    const notiBtn = document.getElementById("notifButton");
    const notifDropdown = document.getElementById("notifDropdown");
    const notifClosePopUp = document.querySelector(".close-noti-popup");
    const notifCount = document.getElementById("notifCount");
    const notifCountContainer = document.querySelector(
        ".notif-count-container"
    );
    const markAllRead = document.querySelector(".mark-all-read");
    const notificationContainer = document.querySelector(
        ".notification-container"
    );

    // Check if user has clicked bell before
    const hasSeenNotifications =
        localStorage.getItem("notificationSeen") === "true";

    // Fetch notifications list
    const data = await fetchNotification();

    if (data && data.length > 0) {
        renderNotificationList(data, notificationContainer);
        console.log(data);

        // Show count only if user has NOT clicked bell before
        // if (!hasSeenNotifications) {
        //     notifCount.textContent = data.length > 9 ? "9+" : data.length;
        //     notifCountContainer.classList.remove("hidden");
        // } else {
        //     notifCount.textContent = 0;
        //     notifCountContainer.classList.add("hidden");
        // }
        if (data.unreadCount > 0) {
            notifCount.textContent =
                data.unreadCount > 9 ? "9+" : data.unreadCount;
            notifCountContainer.classList.remove("hidden");
        } else {
            notifCount.textContent = 0;
            notifCountContainer.classList.add("hidden");
        }
    }

    // Close dropdown if clicking outside
    const handleOverlay = (event) => {
        if (notifDropdown.classList.contains("hidden")) return;

        if (
            !notifDropdown.contains(event.target) &&
            !notiBtn.contains(event.target)
        ) {
            notifDropdown.classList.add("hidden");
        }
    };
    document.addEventListener("click", handleOverlay);

    // On bell click: toggle dropdown, reset count, remember reset
    notiBtn.addEventListener("click", async (e) => {
        e.stopPropagation();
        notifDropdown.classList.toggle("hidden");

        if (!notifDropdown.classList.contains("hidden")) {
            localStorage.setItem("notificationSeen", "true");
            notifCount.textContent = 0;
            notifCountContainer.classList.add("hidden");
            // Optionally mark all notifications as read on server here
            // await markAsReadAllNoti();
        }
    });

    notifClosePopUp.addEventListener("click", () => {
        notifDropdown.classList.add("hidden");
    });

    // Handle click on individual notification item
    const handleNotificationClick = async (e) => {
        const notificationItem = e.target.closest(".notification-item");
        if (!notificationItem) return;

        const orderId = notificationItem.dataset.orderId;
        const notifId = notificationItem.dataset.notificationId;

        await markAsReadNoti(notifId);
        location.href = `/dashboard/order/${orderId}`;
    };
    notificationContainer.addEventListener("click", handleNotificationClick);

    // Handle "Mark all as read" button click
    markAllRead.addEventListener("click", async () => {
        await markAsReadAllNoti();
        const data = await fetchNotification();
        if (data) {
            renderNotificationList(data, notificationContainer);
        }
        notifCount.textContent = 0;
        notifCountContainer.classList.add("hidden");

        localStorage.setItem("notificationSeen", "true");
    });

    // Real-time notification via Laravel Echo
    window.Echo.private(
        `App.Models.User.${window.Laravel.userId}`
    ).notification((notification) => {
        // Only increment count if user has NOT clicked bell before

        localStorage.setItem("notificationSeen", "false");

        let currentCount = parseInt(notifCount.textContent || "0");
        currentCount = isNaN(currentCount) ? 0 : currentCount;
        currentCount += 1;

        notifCount.textContent = currentCount > 9 ? "9+" : currentCount;
        notifCountContainer.classList.remove("hidden");

        // Render notification content
        const template = document.getElementById("notification-template");
        if (!template) {
            console.warn("Notification template not found");
            return;
        }
        const content = template.content.cloneNode(true);

        const markAsRead = content.querySelector(".mark-as-read");
        const orderNumber = content.querySelector(".order-number");
        const customerName = content.querySelector(".customer-name");
        const customerProfile = content.querySelector(".customer-profile");
        const orderStatus = content.querySelector(".order-status");
        const netTotal = content.querySelector(".net-total");
        const orderCreatedAt = content.querySelector(".order-created-at");
        const totalItemCount = content.querySelector(".total-item-count");

        orderNumber.textContent = notification.order_number;
        customerName.textContent = notification.customer_name;

        const defaultImage =
            "https://i0.wp.com/digitalhealthskills.com/wp-content/uploads/2022/11/3da39-no-user-image-icon-27.png?fit=500%2C500&ssl=1";
        const image = notification?.customer?.profile_image;

        customerProfile.src = image
            ? image.startsWith("https")
                ? image
                : `/storage/${image}`
            : defaultImage;

        orderStatus.innerHTML = getStatusBadge(notification.order_status);
        orderStatus.classList.add("notification-order-status");
        netTotal.textContent = numberFormat(notification.net_total) + " MMK";
        orderCreatedAt.textContent = timeStep(notification.created_at);
        totalItemCount.textContent =
            notification.order_items.length > 1
                ? `${notification.order_items.length} items`
                : `${notification.order_items.length} item`;

        if (notification.markAsRead === true) {
            markAsRead.classList.add("hidden");
        }

        notificationContainer.prepend(content);
    });
};

document.addEventListener("DOMContentLoaded", initializeNotification);
