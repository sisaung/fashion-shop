const clearSortAcitveIcon = (item) => {
    const sortProductBtn = document.querySelector(".sort-product-btn");
    console.log(sortProductBtn);
    sortProductBtn.textContent = item.textContent;

    // clear all active check icons
    const allActiveIcons = document.querySelectorAll(".active-sort-product");
    allActiveIcons.forEach((icon) => {
        icon.innerHTML = "";
    });
};
export default clearSortAcitveIcon;
