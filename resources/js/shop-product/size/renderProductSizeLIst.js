import { renderProductSize } from "./renderProductSize";

const renderProductSizeList = (data, container) => {
    container.innerHTML = "";

    if (data) {
        for (let productSize of data) {

            const type = renderProductSize(productSize);
            container.appendChild(type);
        }
    }


};
export default renderProductSizeList;
