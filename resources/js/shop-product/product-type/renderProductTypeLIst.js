import { renderProductType } from "./renderProductType";

const renderProductTypeList = (data, container) => {
    container.innerHTML = "";

    if (data) {
        for (let productType of data) {

            const type = renderProductType(productType);
            container.appendChild(type);
        }
    }

    
};
export default renderProductTypeList;
