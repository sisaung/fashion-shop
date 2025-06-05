
const initializeBrandModal = () => {

    const dropDown = document.querySelector(".drop-down-modal");

    if (!dropDown) return;

    dropDown.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();
       const dropDown = e.target.closest(".drop-down-modal")
       console.log(dropDown)
        console.log('click')
    })


}

document.addEventListener('DOMContentLoaded',initializeBrandModal)
