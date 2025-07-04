import { fetchProductShop } from "../services/fetchProductShop";
import { renderBreadcrumbTotalProduct } from "../shop-product/renderBreadcrumbTotalProduct";
import { renderPaginationList } from "../shop-product/renderPaginationList";
import renderProductList from "../shop-product/renderProductList";
import getWishlist from "../shop-product/wishlist/getWishlist";

export const renderShopBrand = async (brand) => {
    const template = document.getElementById("brand-list-template");
    if (!template) return;

    const content = template.content.cloneNode(true);
    const container = document.getElementById("product-container");
    const totalProductContainer = document.getElementById(
        "total-product-container"
    );
    const paginationContainer = document.getElementById("pagination-container");

    const checkbox = content.querySelector('input[type="checkbox"]');
    content.querySelector(
        ".brand-name"
    ).textContent = `${brand.brand_name} (${brand.products.length})`;

    checkbox.name = "brands[]";
    checkbox.value = brand.brand_name;

    const selectedBrands = new URLSearchParams(window.location.search).getAll(
        "brands[]"
    );

    if (selectedBrands.includes(brand.brand_name)) {
        checkbox.checked = true;
    }

    //  Initial product list render (optional if already loaded elsewhere)
    const wishlistProducts = await getWishlist();
    // const searchParams = new URLSearchParams(window.location.search).toString();
    // const data = await fetchProductShop(`/shop/get?${searchParams}`);
    // if (data?.data) {
    //     await renderProductList(data.data, container, wishlistProducts);
    // }

    checkbox.addEventListener("change", async (e) => {

        const url = new URL(window.location);
        const params = new URLSearchParams(url.search);

        if (e.target.checked) {
            //  Add brand filter without deleting others
            params.append("brands[]", e.target.value);
        } else {
            //  Remove only the unchecked brand from filters
            let brands = params
                .getAll("brands[]")
                .filter((b) => b !== e.target.value);
            params.delete("brands[]"); // clear all brands[]
            brands.forEach((b) => params.append("brands[]", b)); // re-add remaining brands
        }

        //  Update URL
        url.search = params.toString();
        window.history.pushState({}, "", url);

        //  Update checkbox checked state based on updated params
        const updatedBrands = params.getAll("brands[]");
        checkbox.checked = updatedBrands.includes(brand.brand_name);

        //  Fetch products based on updated brand filters
        const data = await fetchProductShop(`/shop/get?${params.toString()}`);
        if (data?.data) {
            await renderProductList(data.data, container, wishlistProducts);
            renderBreadcrumbTotalProduct(data.total, totalProductContainer);
            renderPaginationList(data.links, paginationContainer);
        }
    });

    return content;
};
// import { fetchProductShop } from "../services/fetchProductShop";
// import { renderBreadcrumbTotalProduct } from "../shop-product/renderBreadcrumbTotalProduct";
// import { renderPaginationList } from "../shop-product/renderPaginationList";
// import renderProductList from "../shop-product/renderProductList";
// import getWishlist from "../shop-product/wishlist/getWishlist";

// export const renderShopBrand = async (brand) => {
//     const template = document.getElementById("brand-list-template");
//     if (!template) return;

//     const content = template.content.cloneNode(true);
//     const container = document.getElementById("product-container");
//     const totalProductContainer = document.getElementById("total-product-container");
//     const paginationContainer = document.getElementById("pagination-container");

//     const checkbox = content.querySelector('input[type="checkbox"]');
//     content.querySelector(".brand-name").textContent = `${brand.brand_name} (${brand.products.length})`;

//     checkbox.name = "brands[]";
//     checkbox.value = brand.brand_name;

//     const selectedBrands = new URLSearchParams(window.location.search).getAll("brands[]");

//     // ✅ Keep checkbox checked after refresh if brand is selected
//     if (selectedBrands.includes(brand.brand_name)) {
//         checkbox.checked = true;
//     }

//     // 📝 Initial product list render (optional if already loaded elsewhere)
//     const wishlistProducts = await getWishlist();
//     const searchParams = new URLSearchParams(window.location.search).toString();
//     const data = await fetchProductShop(`/shop/get?${searchParams}`);
//     if (data?.data) {
//         await renderProductList(data.data, container, wishlistProducts);
//     }

//     checkbox.addEventListener("change", async (e) => {
//         const url = new URL(window.location);
//         const params = new URLSearchParams(url.search);

//         if (e.target.checked) {
//             // ✅ Add brand filter without deleting others
//             params.append("brands[]", e.target.value);
//         } else {
//             // ✅ Remove only the unchecked brand from filters
//             let brands = params.getAll("brands[]").filter(b => b !== e.target.value);
//             params.delete("brands[]"); // clear all brands[]
//             brands.forEach(b => params.append("brands[]", b)); // re-add remaining brands
//         }

//         // 🔗 Update URL
//         url.search = params.toString();
//         window.history.pushState({}, "", url);

//         // ✅ Update checkbox checked state based on updated params
//         const updatedBrands = params.getAll("brands[]");
//         checkbox.checked = updatedBrands.includes(brand.brand_name);

//         // 🔄 Fetch products based on updated brand filters
//         const data = await fetchProductShop(`/shop/get?${params.toString()}`);
//         if (data?.data) {
//             await renderProductList(data.data, container, wishlistProducts);
//             renderBreadcrumbTotalProduct(data.total, totalProductContainer);
//             renderPaginationList(data.links, paginationContainer);
//         }
//     });

//     return content;
// };
