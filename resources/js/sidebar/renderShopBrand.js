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

    const { search } = location;

    const selectedBrands = new URLSearchParams(window.location.search).getAll(
        "brands[]"
    );

    if (selectedBrands.includes(brand.brand_name)) {
        checkbox.checked = true;
    }
    // Get selected brands from URL to keep checked state

    // Prepare wishlist for product rendering
    const wishlistProducts = await getWishlist();

   
    // Checkbox change event handler
    checkbox.addEventListener("change", async (e) => {
        const checkedBrandInputs = document.querySelectorAll(
            'input[name="brands[]"]:checked'
        );
        const brands = Array.from(checkedBrandInputs).map(
            (input) => input.value
        );

        const url = new URL(window.location);
        const params = new URLSearchParams();

        if (search) {
            params.append("in_stock", 1);
        }

        brands.forEach((b) => params.append("brands[]", b));

        url.search = params.toString();
        window.history.pushState({}, "", url);

        const data = await fetchProductShop(`/shop/get?${params.toString()}`);

        if (data?.data) {
            await renderProductList(data.data, container, wishlistProducts);
            renderBreadcrumbTotalProduct(data.total, totalProductContainer);
            renderPaginationList(data.links, paginationContainer);
        }
    });

    return content;
};
