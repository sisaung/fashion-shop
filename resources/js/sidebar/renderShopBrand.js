import { fetchBrand } from "../services/fetchBrand";
import { fetchProductShop } from "../services/fetchProductShop";
import { renderBreadcrumbTotalProduct } from "../shop-product/renderBreadcrumbTotalProduct";
import { renderPaginationList } from "../shop-product/renderPaginationList";
import renderProductList from "../shop-product/renderProductList";

export const renderShopBrand = async (brand) => {
    const template = document.getElementById("brand-list-template");
    if (!template) return;
    const content = template.content.cloneNode(true);
    const container = document.getElementById("product-container");
    const totalProductContainer = document.getElementById(
        "total-product-container"
    );

    const paginationContainer = document.getElementById("pagination-container");

    const selectedBrands = new URLSearchParams(window.location.search).getAll(
        "brands[]"
    );
    const checkbox = content.querySelector('input[type="checkbox"]');

    content.querySelector(
        ".brand-name"
    ).textContent = `${brand.brand_name} (${brand.products.length})`;

    checkbox.name = "brands[]";
    checkbox.value = brand.brand_name;

    if (selectedBrands.includes(brand.brand_name)) {
        checkbox.checked = true;
    }

    // inital filter

    if (!container) return;

    const searchParams = new URLSearchParams(window.location.search).toString();
    const data = await fetchProductShop(`/shop/get?${searchParams}`);
    if (data?.data) {
        renderProductList(data?.data, container);
    }

    checkbox.addEventListener("change", async (e) => {
        if (e.target.checked) {
            const url = new URL(window.location);

            url.searchParams.append("brands[]", e.target.value);

            window.history.pushState({}, "", url);
            const searchParams = new URLSearchParams(url.search).toString();
            const data = await fetchProductShop(`/shop/get?${searchParams}`);


            if (data?.data) {
                renderProductList(data?.data, container);
                renderBreadcrumbTotalProduct(
                    data?.total,
                    totalProductContainer
                );
                renderPaginationList(data?.links, paginationContainer);

            }
        } else {
            const url = new URL(window.location);
            url.searchParams.delete("brands[]", e.target.value);
            window.history.pushState({}, "", url);
            const searchParams = new URLSearchParams(url.search).toString();
            const data = await fetchProductShop(`/shop/get?${searchParams}`);
            if (data?.data) {
                renderProductList(data?.data, container);
                renderBreadcrumbTotalProduct(
                    data?.total,
                    totalProductContainer
                );
                renderPaginationList(data?.links, paginationContainer);


            }
        }
    });
    return content;
};
