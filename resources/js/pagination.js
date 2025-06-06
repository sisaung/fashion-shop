import ajax from "./utils/ajax";

const initializePagination = () => {

    const wrapper = document.querySelector(".brand");

    if (!wrapper) return;

    wrapper.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();


        const link = e.target.closest("a");
      
        
       

        if (link && link.href.includes("page=")) {
            ajax(link.href, ".brand", wrapper);
        }
    });

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
                .querySelector(".brand").innerHTML;
            wrapper.innerHTML = newContent;
        } catch (err) {
            console.error("Popstate error:", err);
        }
    });

    //edit form for band

   

//    wrapper.addEventListener('click',handleEditForm)


    // document.addEventListener("click", handlePaginate);
};

document.addEventListener("DOMContentLoaded", initializePagination);
export default initializePagination