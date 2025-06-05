// import { Dropdown, Modal } from 'flowbite';

// export default function reinitializeFlowbite() {
//     // Bind dropdowns
//     document.querySelectorAll('[data-dropdown-toggle]').forEach(triggerEl => {
//         const dropdownId = triggerEl.getAttribute('data-dropdown-toggle');
//         const dropdownEl = document.getElementById(dropdownId);

//         // Prevent double binding
//         if (dropdownEl && !dropdownEl.dataset.bound) {
//             new Dropdown(dropdownEl, triggerEl);
//             dropdownEl.dataset.bound = 'true';
//         }
//     });

//     // Bind modals (if used)
//     document.querySelectorAll('[data-modal-toggle]').forEach(triggerEl => {
//         const modalId = triggerEl.getAttribute('data-modal-target');
//         const modalEl = document.getElementById(modalId);
//         if (modalEl && !modalEl.dataset.bound) {
//             new Modal(modalEl);
//             modalEl.dataset.bound = 'true';
//         }
//     });
// }

import { Dropdown, Modal, initFlowbite } from "flowbite";

export default function reinitializeFlowbite() {
    // First remove any existing Flowbite event listeners
    document.removeEventListener("click", initFlowbite);

    // Then reinitialize all Flowbite components
    initFlowbite();

    // Manually bind dropdowns and modals for newly added elements
    document.querySelectorAll("[data-dropdown-toggle]").forEach((triggerEl) => {
        const dropdownId = triggerEl.getAttribute("data-dropdown-toggle");
        const dropdownEl = document.getElementById(dropdownId);

        if (dropdownEl && !dropdownEl._dropdown) {
            new Dropdown(dropdownEl, triggerEl);
        }
    });

    document.querySelectorAll("[data-modal-toggle]").forEach((triggerEl) => {
        const modalId = triggerEl.getAttribute("data-modal-toggle");
        const modalEl = document.getElementById(modalId);
        console.log(modalEl)

        if (modalEl && !modalEl._modal) {
            new Modal(modalEl, triggerEl);
        }
    });
}
