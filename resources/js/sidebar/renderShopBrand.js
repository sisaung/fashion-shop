import { fetchProductCategory } from "../services/fetchProductCategory";
import { fetchProductShop } from "../services/fetchProductShop";
import { fetchProductType } from "../services/fetchProductType";
import renderProductTypeList from "../shop-product/product-type/renderProductTypeLIst";
import { renderBreadcrumbTotalProduct } from "../shop-product/renderBreadcrumbTotalProduct";
import { renderPaginationList } from "../shop-product/renderPaginationList";
import renderProductCategoryList from "../shop-product/renderProductCategoryLIst";
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
    const productCategoryContainer = document.getElementById(
        "filter-product-category-container"
    );
    const filterProductTypeContainer = document.getElementById(
        "filter-product-type-container"
    );

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

    // console.log(selectedBrands)

    // if (selectedBrands.includes(brand.brand_name)) {
    //     checkbox.checked = true;
    // }
    // Get selected brands from URL to keep checked state

    // Prepare wishlist for product rendering
    const wishlistProducts = await getWishlist();

    // initial render product category

    // if (selectedBrands.length === 0) {
    //     const productCategory = await fetchProductCategory(
    //         `/shop/get-product-category`
    //     );
    //     const productType = await fetchProductCategory(
    //         `/shop/get-product-type`
    //     );

    //     if (productCategory) {
    //         renderProductCategoryList(
    //             productCategory,
    //             productCategoryContainer
    //         );
    //     }

    //     if(productType) {
    //         renderProductTypeList(productType, filterProductTypeContainer);
    //     }
    // } else {
    //     const productCategory = await fetchProductCategory(
    //         `/shop/get-product-category?brands[]=${selectedBrands}`
    //     );

    //     const productType = await fetchProductType(
    //         `/shop/get-product-type?brands[]=${selectedBrands}`
    //     );
    //     if (productCategory) {
    //         renderProductCategoryList(
    //             productCategory,
    //             productCategoryContainer
    //         );
    //     }

    //     if (productType) {
    //         renderProductTypeList(productType, filterProductTypeContainer);
    //     }
    // }

    // Checkbox change event handler
    checkbox.addEventListener("change", async (e) => {
        const checkedBrandInputs = document.querySelectorAll(
            'input[name="brands[]"]:checked'
        );
        const brands = Array.from(checkedBrandInputs).map(
            (input) => input.value
        );

        // const url = new URL(window.location);
        // console.log(url)
        const params = new URLSearchParams(search);
        console.log(params);

        // if (search) {
        //     params.append("in_stock", 1);
        // }
        params.delete("brands[]");
        brands.forEach((b) => params.append("brands[]", b));

        // url.search = params.toString();
        window.history.pushState(
            {},
            "",
            params.toString() ? "shop?" + params.toString() : "shop"
        );

        const data = await fetchProductShop(`/shop/get?${params.toString()}`);
        // const productCategory = await fetchProductCategory(
        //     `/shop/get-product-category?${params.toString()}`
        // );

        // const productType = await fetchProductType(
        //     `/shop/get-product-type?${params.toString()}`
        // );

        if (data?.data) {
            await renderProductList(data.data, container, wishlistProducts);
            renderBreadcrumbTotalProduct(data.total, totalProductContainer);
            renderPaginationList(data.links, paginationContainer);
        }

        // if (productCategory) {
        //     renderProductCategoryList(
        //         productCategory,
        //         productCategoryContainer
        //     );
        // }

        // if (productType) {
        //     renderProductTypeList(productType, filterProductTypeContainer);
        // }
    });

    return content;
};
