import { renderPagination } from "./renderPagination";

export const renderPaginationList = async (links,container,wishlistProducts) => {
    container.innerHTML = "";

    console.log(wishlistProducts)

    if (links && links.length > 0) {


        links.forEach(async (link) => {
            const pagination = await renderPagination(link,wishlistProducts);
            container.appendChild(pagination);
        });
    }
};
