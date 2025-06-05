import ajax from "./utils/ajax";

const initializePagination = () => {
    const wrapper = document.querySelector(".pagination-wrapper");

    const handlePaginate = async (e) => {
        e.preventDefault();

        const link = e.target.closest("a");

        if (link && link.href.includes("page=")) {
            ajax(link.href, ".pagination-wrapper", wrapper);
        }
    };

    // backward forward

    window.addEventListener("popstate", async function () {
        const url = window.location.href;

        try {
            const response = await fetch(url, {
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                },
            });

            const html = await response.text();
            const newContent = new DOMParser()
                .parseFromString(html, "text/html")
                .querySelector(".pagination-wrapper").innerHTML;
            wrapper.innerHTML = newContent;
        } catch (err) {
            console.error("Popstate error:", err);
        }
    });

    document.addEventListener("click", handlePaginate);
};

document.addEventListener("DOMContentLoaded", initializePagination);
