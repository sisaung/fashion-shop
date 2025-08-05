import renderNotification from "./notification/renderNotification";
import renderNotificationList from "./notification/renderNotificationList";
import fetchNotification from "./services/fetchNotification";
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

    const notificationContainer = document.querySelector(
        ".notification-container"
    );

    const data = await fetchNotification();

    if (data) {
        renderNotificationList(data, notificationContainer);
        notifCount.textContent = data.length > 9 ?  '9+': data.length;
        notifCountContainer.classList.remove("hidden");
    }

    const handleOverLay = (event) => {
        if (notifDropdown.classList.contains("hidden")) return;

        if (
            !notifDropdown.contains(event.target) &&
            !notiBtn.contains(event.target)
        ) {
            notifDropdown.classList.add("hidden");
        }
    };

    document.addEventListener("click", handleOverLay);

    notiBtn.addEventListener("click", (e) => {
        e.stopPropagation();
        notifDropdown.classList.toggle("hidden");
    });

    const handleNotiClosePopUp = () => {
        notifDropdown.classList.add("hidden");
    };

    notifClosePopUp.addEventListener("click", handleNotiClosePopUp);



    window.Echo.connector.pusher.connection.bind("connected", function () {
        console.log("Connected to Pusher!");
    });

    window.Echo.private("admin.orders").listen(".order.placed", (e) => {
      
        const list = document.getElementById("notifList");
        const count = document.getElementById("notifCount");
        const notificationContainer = document.querySelector(
            ".notification-container"
        );

        const template = document.getElementById("notification-template");

        if (!template) {
            console.log("not found template");
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

        orderNumber.textContent = e.order_number;
        customerName.textContent = e.customer_name;

        const defaultImage =
            "https://i0.wp.com/digitalhealthskills.com/wp-content/uploads/2022/11/3da39-no-user-image-icon-27.png?fit=500%2C500&ssl=1";
        const image = e?.customer?.profile_image;

        customerProfile.src = image
            ? image.startsWith("https")
                ? image
                : `/storage/${image}`
            : defaultImage;

        orderStatus.innerHTML = getStatusBadge(e.order_status);
        orderStatus.classList.add("notification-order-status");
        netTotal.textContent = numberFormat(e.net_total) + " MMK";
        orderCreatedAt.textContent = timeStep(e.created_at);
        totalItemCount.textContent =
            e.order_items.length > 1
                ? `${e.order_items.length} items`
                : `${e.order_items.length} item`;

        if (e.markAsRead === true) {
            markAsRead.classList.add("hidden");
        }

        notificationContainer.prepend(content);

        count.textContent =
            parseInt(count.textContent) > 9
                ? "9+"
                : parseInt(count.textContent || "0") + 1;
        count.classList.remove("hidden");
    });
};

document.addEventListener("DOMContentLoaded", initializeNotification);



