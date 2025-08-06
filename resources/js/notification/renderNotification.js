import getStatusBadge from "../utils/getStatusBadge";
import numberFormat from "../utils/numberFormat";
import timeStep from "../utils/timeStep";

const renderNotification = (notification) => {
    const template = document.getElementById("notification-template");
    console.log(notification)

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
    const notificationItem = content.querySelector(".notification-item");



        orderNumber.textContent = notification.data.order_number;
        customerName.textContent = notification.data.customer_name;

        const defaultImage =
            "https://i0.wp.com/digitalhealthskills.com/wp-content/uploads/2022/11/3da39-no-user-image-icon-27.png?fit=500%2C500&ssl=1";
        const image = notification?.data?.customer?.profile_image;

        customerProfile.src = image
            ? image.startsWith("https")
                ? image
                : `/storage/${image}`
            : defaultImage;

        // customerProfile.src = notification.order.customer.profile_image
        //     ? notification.order.customer.profile_image
        //     : "https://i0.wp.com/digitalhealthskills.com/wp-content/uploads/2022/11/3da39-no-user-image-icon-27.png?fit=500%2C500&ssl=1";

        orderStatus.innerHTML = getStatusBadge(notification.data.order_status);
        orderStatus.classList.add("notification-order-status");
        netTotal.textContent =
            numberFormat(notification.data.net_total) + " MMK";
        orderCreatedAt.textContent = timeStep(notification.data.created_at);
        totalItemCount.textContent =
            notification.data.order_items.length > 1
                ? `${notification.data.order_items.length} items`
                : `${notification.data.order_items.length} item`;


    if (notification.read_at !== null) {
        markAsRead.classList.add("hidden");
    }
    notificationItem.setAttribute('data-notification-id', notification.id)
    notificationItem.setAttribute('data-order-id', notification.data.order_id)



    return content;
}
export default renderNotification;
