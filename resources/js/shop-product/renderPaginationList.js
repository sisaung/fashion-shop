import { renderPagination } from "./renderPagination";

export const renderPaginationList = async (
    links,
    container,
    wishlistProducts
) => {
    container.innerHTML = "";

    if (!links || links.length === 0) return;

    const firstLink = links.find(link => link.label === "1");
    const prevLink = links.find(link => link.label.includes("Previous"));
    const nextLink = links.find(link => link.label.includes("Next"));
    const lastLink = links[links.length - 2]; // Laravel last page is second last before Next

    const activeIndex = links.findIndex(link => link.active);
    const activePage = parseInt(links[activeIndex].label);
    const lastPageNumber = parseInt(lastLink.label);

    // Calculate page range (max 5 visible pages)
    let startPage = Math.max(2, activePage - 2);
    let endPage = Math.min(lastPageNumber - 1, activePage + 2);

    // Adjust if near the start
    if (activePage <= 3) {
        startPage = 2;
        endPage = Math.min(5, lastPageNumber - 1);
    }

    // Adjust if near the end
    if (activePage >= lastPageNumber - 2) {
        endPage = lastPageNumber - 1;
        startPage = Math.max(2, lastPageNumber - 4);
    }

    // Render Prev
    if (prevLink) {
        const prevBtn = await renderPagination(prevLink, wishlistProducts);
        container.appendChild(prevBtn);
    }


    // Render First page
    if (firstLink) {
        const firstBtn = await renderPagination(firstLink, wishlistProducts);
        container.appendChild(firstBtn);
    }

    // Show "..." after first page if needed
    if (startPage > 2) {
        const dots = document.createElement("span");
        dots.textContent = "...";
        dots.classList.add("px-2", "text-gray-500");
        container.appendChild(dots);
    }

    // Render middle page links (max 5 visible pages)
    for (let i = startPage; i <= endPage; i++) {
        const link = links.find(link => parseInt(link.label) === i);
        if (link) {
            const pageBtn = await renderPagination(link, wishlistProducts);
            container.appendChild(pageBtn);
        }
    }

    // Show "..." before last page if needed
    if (endPage < lastPageNumber - 1) {
        const dots = document.createElement("span");
        dots.textContent = "...";
        dots.classList.add("px-2", "text-gray-500");
        container.appendChild(dots);
    }

    if (lastLink && lastPageNumber !== 1) {
        const lastBtn = await renderPagination(lastLink, wishlistProducts);
        container.appendChild(lastBtn);
    }

    // Render Next
    if (nextLink) {
        const nextBtn = await renderPagination(nextLink, wishlistProducts);
        container.appendChild(nextBtn);
    }
};
