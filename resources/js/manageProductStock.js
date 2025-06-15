
const initializeManageProductStock = () => {

    const currentUrl = location.search;
    const container = document.querySelector('.body-container');

    if(!container) return ;


    const handleClick = (e) => {
      e.preventDefault();
      // e.stopPropagation();

      const manageProductStockUrl = e.target.closest('[data-manage-stock]')

      if(manageProductStockUrl) {

          const action = manageProductStockUrl.dataset.manageStock;
        location.href = `${action}${currentUrl}`


      }


    }

    container.addEventListener("click",handleClick)



  }

  document.addEventListener('DOMContentLoaded',initializeManageProductStock)
