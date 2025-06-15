
const initializeRedirectToDetail = () => {

    const currentUrl = location.search;
    const container = document.querySelector('.body-container');

    if(!container) return ;


    const handleClick = (e) => {
      e.preventDefault();
      // e.stopPropagation();

      const detailUrl = e.target.closest('[data-detail]')


      if(detailUrl) {

          const action = detailUrl.dataset.detail;



     location.href = `${action}${currentUrl}`


      }

    }

    container.addEventListener("click",handleClick)



  }

  document.addEventListener('DOMContentLoaded',initializeRedirectToDetail)
