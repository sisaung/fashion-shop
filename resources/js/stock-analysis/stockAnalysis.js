// import fetchStockByBrand from "../services/fetchStockbyBrand.js";
// import fetchStockByProductType from "../services/fetchStockByProductType";
// import fetchStockSizeChart from "../services/fetchStockSizeChart.js";
// import renderStockByBrandList from "./renderStockByBrandList";
// import renderStockByProductTypeList from "./renderStockByTypeList";
// import Chart from 'chart.js/auto';

// const initializeStockAnalysis = async () => {
//     const productTypeContainer = document.querySelector(
//         ".stock-by-product-type-container"
//     );
//     const brandContainer = document.querySelector(".stock-by-brand-container");
//     const clearProductType = document.querySelector(
//         ".clear-stock-by-product-type"
//     );
//     const { search } = location;

//     const productType = await fetchStockByProductType();
//     const brand = await fetchStockByBrand();

//     if (productType) {
//         await renderStockByProductTypeList(productType, productTypeContainer);
//         const productTypeBtn = document.querySelectorAll(
//             ".stock-by-product-type-btn"
//         );

//         const param = new URLSearchParams(search);

//         if (param.get("stock_by_product_type")) {
//             const productTypeId = param.get("stock_by_product_type");
//             clearProductType.classList.remove("hidden");

//             const productTypeBtn = document.querySelectorAll(
//                 ".stock-by-product-type-btn"
//             );

//             productTypeBtn.forEach((btn) => {
//                 if (btn.dataset.productTypeId == productTypeId) {
//                     btn.classList.add("bg-pearl-bush-100");
//                 }
//             });
//         }

//         productTypeBtn.forEach((btn) => {
//             btn.addEventListener("click", async () => {
//                 clearProductType.classList.remove("hidden");
//                 const { search } = location;
//                 const productTypeId = btn.dataset.productTypeId;

//                 const searchParam = new URLSearchParams(search);
//                 const paramObj = Object.fromEntries(searchParam);

//                 const newParams = {
//                     ...paramObj,
//                     stock_by_product_type: productTypeId,
//                 };

//                 const queryString = new URLSearchParams(newParams).toString();
//                 history.pushState(null, null, "?" + queryString);

//                 productTypeBtn.forEach((btn) => {
//                     if (btn.dataset.productTypeId !== productTypeId) {
//                         btn.classList.remove("bg-pearl-bush-100");
//                     }
//                 });

//                 btn.classList.add("bg-pearl-bush-100");
//                 btn.classList.add("text-pearl-bush-700");

//                 const brand = await fetchStockByBrand(queryString);
//                 await renderStockByBrandList(brand, brandContainer);

//                const data = await fetchStockSizeChart(queryString);

//                 const ctx = document
//                     .getElementById("sizeStockChart")
//                     .getContext("2d");
//                 const labels = data.map((i) => i.size_name);
//                 const stocks = data.map((i) => i.total_stock);

//                 const chartData = {
//                     labels: labels,
//                     datasets: [
//                         {
//                             label: "Stock Count",
//                             data: stocks,
//                             backgroundColor: "rgba(54, 162, 235, 0.6)",
//                         },
//                     ],
//                 };

//                 const config = {
//                     type: "bar",
//                     data: chartData,
//                     options: {
//                         responsive: true,
//                         scales: {
//                             y: { beginAtZero: true },
//                         },
//                     },
//                 };

//                 // Destroy existing chart if reloading
//                 if (window.sizeStockChart) {
//                     window.sizeStockChart.destroy();
//                 }
//                 window.sizeStockChart = new Chart(ctx, config);
//             });
//         });
//     }

//     if (brand) {
//         await renderStockByBrandList(brand, brandContainer);
//     }

//     const handleClearProductType = async () => {
//         const search = location.search;
//         const searchParams = new URLSearchParams(search);
//         searchParams.delete("stock_by_product_type");
//         history.pushState(
//             "",
//             "",
//             searchParams.toString()
//                 ? `?${searchParams.toString()}`
//                 : location.origin + location.pathname
//         );
//         clearProductType.classList.add("hidden");

//         const brand = await fetchStockByBrand();
//         await renderStockByBrandList(brand, brandContainer);
//         const productTypeBtn = document.querySelectorAll(
//             ".stock-by-product-type-btn"
//         );

//         productTypeBtn.forEach((btn) => {
//             btn.classList.remove("bg-pearl-bush-100");
//         });
//     };

//     clearProductType.addEventListener("click", handleClearProductType);
// };
// document.addEventListener("DOMContentLoaded", initializeStockAnalysis);
import fetchAllTotalPrice from "../services/fetchAllTotalPrice.js";
import fetchStockByBrand from "../services/fetchStockbyBrand.js";
import fetchStockByProductType from "../services/fetchStockByProductType.js";
import fetchStockSizeChart from "../services/fetchStockSizeChart.js";
import fetchTotalStock from "../services/fetchTotalStock.js";
import highlightSelectedBrand from "../utils/highlightSelectBrand.js";
import showAllTotalPrice from "../utils/showAllTotalPrice.js";
import renderStockByBrandList from "./renderStockByBrandList.js";
import renderStockByProductTypeList from "./renderStockByTypeList.js";
import Chart, { plugins } from "chart.js/auto";
import renderStockCategoryList from "./renderStockCategoryList.js";

const initializeStockAnalysis = async () => {
    const productTypeContainer = document.querySelector(
        ".stock-by-product-type-container"
    );
    const brandContainer = document.querySelector(".stock-by-brand-container");
    const clearProductType = document.querySelector(
        ".clear-stock-by-product-type"
    );

    const clearBrand = document.querySelector(".clear-stock-by-brand");
    const categoryContainer = document.querySelector(
        ".total-stock-by-category-container"
    );

    const stockTotal = document.querySelector(".stock-total");

    const searchParam = new URLSearchParams(location.search);

    // Fetch initial data
    const [productTypes, brands, allTotalStock] = await Promise.all([
        fetchStockByProductType(),
        fetchStockByBrand(),
        fetchTotalStock(),
    ]);

    // Render product type buttons
    if (productTypes) {
        await renderStockByProductTypeList(productTypes, productTypeContainer);
        setupProductTypeButtons();
    }

    // Render brand list initially
    if (brands) {
        await renderStockByBrandList(brands, brandContainer);
        setupBrandButtons();
    }

    // function renderChart(data) {
    //     const ctx = document.getElementById("sizeStockChart").getContext("2d");
    //     const labels = data?.map((i) => i.size_name);
    //     const stocks = data?.map((i) => i.total_stock);

    //     const config = {
    //         type: "bar",
    //         data: {
    //             labels,
    //             datasets: [
    //                 {
    //                     label: "Stock Count",
    //                     data: stocks,
    //                     backgroundColor: "#ccb6a5",
    //                 },
    //             ],
    //         },
    //         options: {
    //             responsive: true,
    //             scales: {
    //                 y: { beginAtZero: true },
    //             },

    //             plugins: {
    //                 datalabels: {
    //                     anchor: "end", // position at top
    //                     align: "end", // align text at top
    //                     color: "#694943", // label text color
    //                 },
    //             },
    //         },
    //     };

    //     // Destroy existing chart before creating new one
    //     if (
    //         window.sizeStockChart &&
    //         typeof window.sizeStockChart.destroy === "function"
    //     ) {
    //         window.sizeStockChart.destroy();
    //     }
    //     window.sizeStockChart = new Chart(ctx, config);
    // }

    function renderChart(data) {
        const ctx = document.getElementById("sizeStockChart").getContext("2d");
        const labels = data?.map((i) => i.size_name) || [];
        const stocks = data?.map((i) => i.total_stock) || [];

        // Decide bar size based on number of labels
        // Smaller bar if only one label, else normal size
        const isSingleSize = labels.length === 1;
        const barThickness = isSingleSize ? 60 : undefined; // 20px if single, else automatic
        const maxBarThickness = isSingleSize ? 60 : 60; // smaller max width if single

        const config = {
            type: "bar",
            data: {
                labels,
                datasets: [
                    {
                        label: "Stock Count",
                        data: stocks,
                        backgroundColor: "#ccb6a5",
                        barThickness, // fixed thickness if single
                        maxBarThickness, // max width of bar
                    },
                ],
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true },
                },
                plugins: {
                    datalabels: {
                        anchor: "end",
                        align: "end",
                        color: "#694943",
                    },
                },
            },
        };

        // Destroy existing chart before creating new one
        if (
            window.sizeStockChart &&
            typeof window.sizeStockChart.destroy === "function"
        ) {
            window.sizeStockChart.destroy();
        }

        window.sizeStockChart = new Chart(ctx, config);
    }

    renderChart(
        searchParam.toString()
            ? await fetchStockSizeChart(searchParam.toString())
            : null
    );

    // total stock category
    const stockCategories = await fetchTotalStock();
    const data = await fetchAllTotalPrice();
    stockTotal.textContent = stockCategories.totalStock;
    renderStockCategoryList(stockCategories.categories, categoryContainer);
    showAllTotalPrice(data);

    function renderCategoryChart(data) {
        data.categories.sort((a, b) => b.stock - a.stock);

        // ✅ Your fixed colors
        const fixedColors = [
            "#9b6c5b",
            "#a87d67",
            "#b79580",
            "#ccb6a5",
            "#e0d3c8",
        ];

        // ✅ Find max stock
        const maxStock = data.categories[0].stock;

        // ✅ Assign colors in sorted order
        data.categories.forEach((category, index) => {
            if (category.stock === maxStock) {
                category.color = "#81584d"; // bright gold for highest
            } else {
                category.color = fixedColors[index % fixedColors.length];
            }
        });

        // ✅ Prepare data for Chart.js
        const labels = data.categories.map((c) => c.name);
        const stocks = data.categories.map((c) => c.stock);
        const colors = data.categories.map((c) => c.color);

        // ✅ Render Chart.js donut
        const ctx = document
            .getElementById("categoryStockChart")
            .getContext("2d");

        new Chart(ctx, {
            type: "doughnut",
            data: {
                labels: labels,
                datasets: [
                    {
                        data: stocks,
                        backgroundColor: colors,
                        borderWidth: 1,
                        hoverOffset: 10,
                    },
                ],
            },
            options: {
                // rotation: -90, // ✅ starts from left side
                // circumference: 360,
                plugins: {
                    datalabels: {
                        display: false,
                    },
                    legend: { display: false },
                    tooltip: { enabled: false },
                    title: {
                        display: true,
                    },
                },
            },
        });
    }

    renderCategoryChart(allTotalStock);

    // Set up clear button
    clearProductType.addEventListener("click", handleClearProductType);
    clearBrand.addEventListener("click", handleClearBrand);

    // Function to set up click events for product type buttons
    async function setupProductTypeButtons() {
        const productTypeBtns = document.querySelectorAll(
            ".stock-by-product-type-btn"
        );
        const params = new URLSearchParams(location.search);
        const selectedProductTypeId = params.get("stock_by_product_type");

        // Highlight button if already selected via URL
        if (selectedProductTypeId) {
            clearProductType.classList.remove("hidden");
            productTypeBtns.forEach((btn) => {
                if (btn.dataset.productTypeId === selectedProductTypeId) {
                    btn.classList.add("active-selected-stock");
                }
            });
            await updateBrandAndChart(selectedProductTypeId);
            const data = await fetchAllTotalPrice(params.toString());

            console.log(data);
            showAllTotalPrice(data);
        }

        productTypeBtns.forEach((btn) => {
            btn.addEventListener("click", async () => {
                const productTypeId = btn.dataset.productTypeId;

                // Update URL
                const searchParams = new URLSearchParams(location.search);
                searchParams.delete("stock_by_brand");
                searchParams.set("stock_by_product_type", productTypeId);
                history.pushState(null, null, "?" + searchParams.toString());

                // Highlight selected button
                productTypeBtns.forEach((b) =>
                    b.classList.remove("active-selected-stock")
                );
                btn.classList.add("active-selected-stock");

                clearProductType.classList.remove("hidden");

                // Update brand list and chart
                await updateBrandAndChart(productTypeId, null);
                const data = await fetchAllTotalPrice(searchParams.toString());
                showAllTotalPrice(data);
            });
        });
    }

    // Function to set up click events for brand buttons
    // async function setupBrandButtons() {
    //     const brandBtns = document.querySelectorAll(".stock-by-brand-btn");
    //     const params = new URLSearchParams(search);
    //     const selectedBrandId = params.get("stock_by_brand");

    //     // Highlight button if already selected via URL
    //     if (selectedBrandId) {
    //         clearBrand.classList.remove("hidden");
    //         brandBtns.forEach((btn) => {

    //             if (btn.dataset.brandId === selectedBrandId) {
    //                 btn.classList.add("bg-pearl-bush-100");
    //             }
    //         });
    //         await updateBrandAndChart(selectedBrandId);
    //     }

    //     brandBtns.forEach((btn) => {
    //         btn.addEventListener("click", async () => {
    //             console.log("click");
    //             const brandId = btn.dataset.brandId;

    //             console.log();
    //             // Update URL
    //             const searchParams = new URLSearchParams(location.search);
    //             searchParams.set("stock_by_brand", brandId);
    //             history.pushState(null, null, "?" + searchParams.toString());

    //             // Highlight selected button
    //             brandBtns.forEach((b) =>
    //                 b.classList.remove(
    //                     "bg-pearl-bush-100",
    //                     "text-pearl-bush-700"
    //                 )
    //             );
    //             btn.classList.add("bg-pearl-bush-100", "text-pearl-bush-700");

    //             clearBrand.classList.remove("hidden");

    //             // Update brand list and chart
    //             await updateBrandAndChart(brandId);
    //         });
    //     });
    // }

    async function setupBrandButtons() {
        highlightSelectedBrand();

        brandContainer.addEventListener("click", async (e) => {
            const brandBtns = document.querySelectorAll(".stock-by-brand-btn");

            const brandBtn = e.target.closest(".stock-by-brand-btn");
            if (brandBtn) {
                const brandId = brandBtn.dataset.brandId;
                const searchParams = new URLSearchParams(location.search);
                searchParams.set("stock_by_brand", brandId);
                history.pushState(null, null, "?" + searchParams.toString());

                // Highlight selected button
                brandBtns.forEach((b) =>
                    b.classList.remove("active-selected-stock")
                );
                brandBtn.classList.add("active-selected-stock");

                clearBrand.classList.remove("hidden");

                // Update brand list and chart
                await updateBrandAndChart(null, brandId);
                console.log(searchParams.toString());
                const data = await fetchAllTotalPrice(searchParams.toString());
                console.log(data);
                showAllTotalPrice(data);
            }
        });
    }

    // Function to update brand list and render chart
    async function updateBrandAndChart(productTypeId, brandId) {
        const params = new URLSearchParams();

        if (productTypeId) {
            params.set("stock_by_product_type", productTypeId);
        }

        if (brandId) {
            params.set("stock_by_brand", brandId);
        }

        // for brand
        const queryString = params.toString();

        // for size chart
        const param = location.search;
        const searchParam = new URLSearchParams(param).toString();

        // Fetch and render brand list
        const updatedBrands = await fetchStockByBrand(searchParam);
        await renderStockByBrandList(updatedBrands, brandContainer);
        highlightSelectedBrand();

        // Fetch and render chart
        const data = await fetchStockSizeChart(searchParam);
        renderChart(data);
    }

    // Function to render chart

    // function to render category chart

    // Function to handle clearing selected product type
    async function handleClearProductType() {
        const searchParams = new URLSearchParams(location.search);
        searchParams.delete("stock_by_product_type");
        searchParams.delete("stock_by_brand");

        // history.pushState(null, null, location.origin + location.pathname);
        history.pushState(null, null, location.origin + location.pathname);

        clearProductType.classList.add("hidden");

        // Re-fetch and render brand list without filter
        const brands = await fetchStockByBrand();
        await renderStockByBrandList(brands, brandContainer);

        // Remove highlight from all buttons
        const productTypeBtns = document.querySelectorAll(
            ".stock-by-product-type-btn"
        );

        renderChart(null);

        highlightSelectedBrand();

        productTypeBtns.forEach((btn) => {
            console.log("false");
            btn.classList.remove("active-selected-stock");
        });

        // Destroy chart if exists
        // if (
        //     window.sizeStockChart &&
        //     typeof window.sizeStockChart.destroy === "function"
        // ) {
        //     window.sizeStockChart.destroy();
        //     window.sizeStockChart = null;
        // }

        const data = await fetchAllTotalPrice();
        showAllTotalPrice(data);
    }

    async function handleClearBrand() {
        const searchParams = new URLSearchParams(location.search);
        searchParams.delete("stock_by_brand");
        const newUrl = searchParams.toString()
            ? "?" + searchParams.toString()
            : location.pathname;
        history.pushState(null, null, newUrl);

        clearBrand.classList.add("hidden");

        // Re-fetch and render brand list without filter
        const brands = await fetchStockByBrand();
        await renderStockByBrandList(brands, brandContainer);

        //refetch and render chart
        if (!searchParams.toString()) {
            renderChart(null);
        } else {
            const dataStockSize = await fetchStockSizeChart(
                searchParams.toString()
            );
            renderChart(dataStockSize);
        }

        // Remove highlight from all buttons
        const brandBtns = document.querySelectorAll(".stock-by-brand-btn");

        brandBtns.forEach((btn) =>
            btn.classList.remove("active-selected-stock")
        );

        // Destroy chart if exists
        // if (
        //     window.sizeStockChart &&
        //     typeof window.sizeStockChart.destroy === "function"
        // ) {
        //     window.sizeStockChart.destroy();
        //     window.sizeStockChart = null;
        // }

        console.log(searchParams.toString());
        const data = await fetchAllTotalPrice(searchParams.toString());
        showAllTotalPrice(data);
    }
};

document.addEventListener("DOMContentLoaded", initializeStockAnalysis);
