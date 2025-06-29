import renderSearchProduct from "./renderSearchProduct";

const renderSearchProductList = (data, container) => {
    container.innerHTML = "";
    const emptypSearchProductTemplate = document.getElementById(
        "empty-search-product-template"
    );
    const content = emptypSearchProductTemplate.content.cloneNode(true);
    const searchHeaderResult = document.querySelector(".header-search-result");
    const searchResultBtn = document.querySelector(".search-result-btn");

    if (data.length > 0) {
        data.forEach((product) => {
            const card = renderSearchProduct(product);
            container.appendChild(card);
        });
    } else {
        container.appendChild(content);
        console.log(searchResultBtn);

        searchHeaderResult.classList.add("hidden");
        searchResultBtn.classList.add("hidden");

    }
};

export default renderSearchProductList;
