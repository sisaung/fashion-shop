import { renderProductCategory } from "./renderProductCategory";

const renderProductCategoryList = (data, container) => {
    container.innerHTML = "";

    if (data) {
        for (let productCategory of data) {
            const category = renderProductCategory(productCategory);

            container.appendChild(category);
        }
    }


};
export default renderProductCategoryList;
