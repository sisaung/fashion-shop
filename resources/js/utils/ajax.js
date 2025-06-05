import reinitializeFlowbite from "../reinitializeFlowbite";
import initializeSorting from "../sorting";

const ajax = async (url, selector, renderSelector) => {
    try {
        const res = await fetch(url, {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },
        });

        const htmlText = await res.text();

        const newContent = new DOMParser()
            .parseFromString(htmlText, "text/html")
            .querySelector(selector).innerHTML;

        renderSelector.innerHTML = newContent;

        reinitializeFlowbite();
        initializeSorting();

        window.history.pushState({}, "", url);
    } catch (error) {
        console.log(error);
    }
};

export default ajax;

// const ajax = (url, selector, renderSelector) => {
//     $.ajax({
//         url: url,
//         type: "GET",
//         dataType: "html", // assuming server returns HTML snippet for sorting-wrapper
//         headers: {
//             "X-Requested-With": "XMLHttpRequest",
//         },
//         success: function (data) {
//             const newContent = new DOMParser()
//                 .parseFromString(data, "text/html")
//                 .querySelector(selector).innerHTML;
//             console.log(newContent);

//             renderSelector.html(newContent); // Update sorting-wrapper content
//             window.history.pushState({ path: url }, "", url);

//             // Reinitialize dropdowns here if needed
//             // if (typeof reinitializeDropdowns === "function") {
//             //     reinitializeDropdowns();
//             // }
//         },
//         error: function (xhr, status, error) {
//             console.error("Error during sorting:", error);
//         },
//     });
// };
// export default  ajax
