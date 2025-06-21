const initializeSetUpFilterEvent = () => {
    const selectedFilters = {
        productCategory_id: null,
        productType_id: null,
    };

    // For product category
    document
        .getElementById("filter-product-category-container")
        .addEventListener("click", (e) => {
            if (e.target.classList.contains("filter-category-btn")) {
                // Remove active from all
                document
                    .querySelectorAll(".filter-category-btn")
                    .forEach((btn) => {
                        btn.classList.remove("bg-pearl-bush-400", "text-white");
                    });

                // Add active to clicked
                e.target.classList.add("bg-pearl-bush-400", "text-white");

                // ✅ Get selected category ID
                selectedFilters.productCategory_id = e.target.getAttribute(
                    "data-product-category"
                );
            }
        });

    // For product type
    document
        .getElementById("filter-product-type-container")
        .addEventListener("click", (e) => {
            if (e.target.classList.contains("filter-productType-btn")) {
                document
                    .querySelectorAll(".filter-productType-btn")
                    .forEach((btn) => {
                        btn.classList.remove("bg-pearl-bush-400", "text-white");
                    });

                e.target.classList.add("bg-pearl-bush-400", "text-white");

                // ✅ Get selected type ID
                selectedFilters.productType_id =
                    e.target.getAttribute("data-product-type");
            }
        });

    //apply filter btn

    document
        .getElementById("apply-filters-btn")
        .addEventListener("click", () => {
            const params = new URLSearchParams();

            console.log(selectedFilters);

            if (selectedFilters.productCategory_id) {
                params.append(
                    "filters[productCategory_id]",
                    selectedFilters.productCategory_id
                );
            }

            if (selectedFilters.productType_id) {
                params.append(
                    "filters[productType_id]",
                    selectedFilters.productType_id
                );
            }

            const url = `/shop?${params.toString()}`;

            if (
                selectedFilters.productCategory_id ||
                selectedFilters.productType_id
            ) {
                history.pushState({}, "", url);
            }

            console.log("Fetching from:", url);
            // fetch(url)...
        });

    //apply resest btn
    document
        .getElementById("apply-clears-btn")
        .addEventListener("click", () => {
            selectedFilters.productCategory_id = null;
            selectedFilters.productType_id = null;

            document.querySelectorAll(".filter-category-btn").forEach((btn) => {
                btn.classList.remove("bg-pearl-bush-400", "text-white");
            });

            document
                .querySelectorAll(".filter-productType-btn")
                .forEach((btn) => {
                    btn.classList.remove("bg-pearl-bush-400", "text-white");
                });

                window.history.pushState({}, "", "/shop");
            // Reset fetch
            // console.log("Fetching all: /shop");
        });
};

document.addEventListener("DOMContentLoaded", initializeSetUpFilterEvent);
