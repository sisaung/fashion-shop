import { initDropdowns, initModals, initFlowbite } from 'flowbite'
import initializePagination from '../pagination';
import initializeSorting from '../sorting';
import { initializeEditForm } from '../editForm';

const ajax = async (url, selector, renderSelector) => {
    console.log('AJAX request started for URL:', url);
    console.log('Targeting selector in response:', selector);
    console.log('Rendering into DOM element:', renderSelector);
    try {
        const res = await fetch(url, {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },
        });

        const htmlText = await res.text();

        const parsedHtml = new DOMParser()
            .parseFromString(htmlText, "text/html")



        const selectedElement = parsedHtml.querySelector(selector);

        console.log(selectedElement);


        if (!selectedElement) {
            console.warn(`Selector "${selector}" not found in the response HTML.`);
            return;
        }

        renderSelector.innerHTML = selectedElement.innerHTML;

        // initializePagination()
        // initFlowbite();
        // initializeEditForm();


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
