import { renderBreadcrumb } from "./renderBreadcrumb";
import { renderPagination } from "./renderPagination";

export const renderPaginationList = ( links,container) => {
    container.innerHTML = "";

    if (links && links.length > 0) {
        links.forEach((link) => {
            const pagination = renderPagination(link);
            container.appendChild(pagination);
        });
    }
};
