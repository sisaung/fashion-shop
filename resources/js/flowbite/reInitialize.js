import { Modal } from "flowbite";

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("[data-modal-toggle]").forEach((btn) => {
        const target = btn.getAttribute("data-modal-target");
        const modalEl = document.getElementById(target);
        if (modalEl) {
            new Modal(modalEl);
        }
    });
});
