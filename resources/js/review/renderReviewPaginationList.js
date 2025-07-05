import { renderReviewPagination } from "./renderReviewPagination";

export const renderReviewPaginationList = async (
    links,
    container,

) => {
    container.innerHTML = "";



    if (links && links.length > 0 && links[2].url != null) {

        links.forEach(async (link) => {
            const pagination = await renderReviewPagination(link);

            container.appendChild(pagination);
        });
    }
};
