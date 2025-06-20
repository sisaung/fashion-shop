document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const closeBtn = document.getElementById("closeSidebar");
    closeBtn?.addEventListener("click", () => {
        sidebar.classList.add("-translate-x-full");
    });

    // Dropdown toggles
    document.querySelectorAll(".filter-toggle").forEach((button) => {
        const target = button.getAttribute("data-target");
        const section = document.getElementById(`filter-${target}`);
        const chevron = document.getElementById(`chevron-${target}`);

        button.addEventListener("click", () => {
            const isOpen =
                section.style.maxHeight && section.style.maxHeight !== "0px";

            if (isOpen) {
                section.style.maxHeight = "0px";
                chevron.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="size-5 text-gray-600">
              <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>
          `;
            } else {
                section.style.maxHeight = section.scrollHeight + "px";
                chevron.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="size-5 text-gray-600">
              <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
            </svg>
          `;
            }
        });
    });

    // Stock toggle animation
    const stockCheckbox = document.getElementById("inStockOnly");
    const toggleBg = document.getElementById("stockToggleBg");
    const toggleDot = document.getElementById("stockToggleDot");

    function updateToggleUI() {
        if (stockCheckbox.checked) {
            toggleBg.classList.remove("bg-gray-300");
            toggleBg.classList.add("bg-pearl-bush-500");
            toggleDot.style.transform = "translateX(16px)";
        } else {
            toggleBg.classList.remove("bg-pearl-bush-500");
            toggleBg.classList.add("bg-gray-300");
            toggleDot.style.transform = "translateX(0)";
        }
    }

    if (stockCheckbox) {
        updateToggleUI();
        stockCheckbox.addEventListener("change", updateToggleUI);
    }
});
