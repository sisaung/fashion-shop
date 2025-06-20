import { renderBreadcrumb } from "./renderBreadcrumb";

export const renderBreadcrumbTotalProduct = (total, container) => {
    container.innerHTML = "";

    if (total) {
        const totalProduct = renderBreadcrumb(total);
        container.appendChild(totalProduct);
    }
};
