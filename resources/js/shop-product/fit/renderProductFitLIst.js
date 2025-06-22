import { renderProductFit } from "./renderProductFit";

const renderProductFitList = (data, container) => {
    container.innerHTML = "";

    if (data) {
        for (let productType of data) {

            const type = renderProductFit(productType);
            container.appendChild(type);
        }
    }


};
export default renderProductFitList;
