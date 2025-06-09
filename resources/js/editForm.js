// In your main JavaScript file (e.g., resources/js/app.js or a dedicated script)

import { initFlowbite } from "flowbite";
import ajax from "./utils/ajax";
import initializePagination from "./pagination";
import initializeSorting from "./sorting";

export const initializeEditForm = () => {
    initFlowbite();

    const container = document.getElementById("brand-list-container");

    const handleBrandEditForm = async (e) => {
        e.preventDefault();

        if (!container) return;

        const editButton = e.target.closest(".edit-brand-btn");
        if (editButton) {
            const editUrl = editButton.dataset.editUrl;

            if (editUrl) {
                await ajax(editUrl, "#edit-form", container);
            } else {
                console.log("error");
            }
        }
    };

    container.addEventListener("click", handleBrandEditForm);

    // Event delegation for dynamically added 'Edit' buttons
    // document.body.addEventListener('click', async (event) => {
    //     const editButton = event.target.closest('.edit-brand-btn');
    //     if (editButton) {
    //         event.preventDefault(); // Prevent default form submission if it was a form button
    //         const editUrl = editButton.dataset.editUrl;

    //         if (editUrl) {
    //             // Assuming you want to load the edit form into the main content area
    //             // You'll need to define what selector on the edit page contains the content
    //             // and what selector on the current page should receive it.
    //             // For example, if your layout has a <main id="dashboard-content"> tag
    //             // and your edit view also has a <main id="edit-form-content"> tag.
    //             // await ajax(editUrl, '#dashboard-content', document.querySelector('#dashboard-content'));
    //             console.log(editUrl)
    //         }
    //     }

    //     // You might need to re-initialize Flowbite dropdowns after AJAX if they're not working
    //     // due to being inside the updated content.
    //     // initFlowbite(); // This is called in your ajax function, which is good.
    // });

    initializePagination();
    initializeSorting();
};

document.addEventListener("DOMContentLoaded", initializeEditForm);
