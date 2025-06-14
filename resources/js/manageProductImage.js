
const initializeManageProductImage = () => {

    const currentUrl = location.search;
    const container = document.querySelector('.body-container');

    if(!container) return ;


    const handleClick = (e) => {
      e.preventDefault();
      // e.stopPropagation();

      const manageProductImageUrl = e.target.closest('[data-manage-image]')

      if(manageProductImageUrl) {

          const action = manageProductImageUrl.dataset.manageImage;
        location.href = `${action}${currentUrl}`


      }


    }

    container.addEventListener("click",handleClick)



  }

  document.addEventListener('DOMContentLoaded',initializeManageProductImage)
