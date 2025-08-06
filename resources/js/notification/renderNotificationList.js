import renderNotification from "./renderNotification";

const renderNotificationList = (data, container) => {

    // const emptyProductContainer = document.getElementById(
    //     "empty-product-container"
    // );
    // const emptyProductTemplate = document.getElementById(
    //     "product-empty-template"
    // );
    container.innerHTML = "";
    // if (emptyProductContainer) {
    //     emptyProductContainer.innerHTML = "";
    // }

    if (data.length > 0) {
        for (let notification of data) {
            const notificationList =  renderNotification(notification);
            container.appendChild(notificationList);
        }
    } else {
        console.log('empty notifications')
        // if (!emptyProductTemplate || !emptyProductContainer) return;
        // const content = emptyProductTemplate.content.cloneNode(true);
        // const backShopNow = content.querySelector(".back-shop-now");
        // backShopNow.addEventListener("click", () => {
        //     window.location.href = "/shop";
        // });
        // emptyProductContainer.appendChild(content);
    }
}
export default renderNotificationList
