
const initializeCustomerDetail = () => {

    const currentUrl = location.search;
    const container = document.querySelector('.body-container');

    if(!container) return ;


    const handleClick = (e) => {
      e.preventDefault();
      // e.stopPropagation();

      const customerDetail = e.target.closest('[data-customer-detail]')

      if(customerDetail) {

          const action = customerDetail.dataset.customerDetail;

        

     location.href = `${action}${currentUrl}`


      }



    }

    container.addEventListener("click",handleClick)



  }

  document.addEventListener('DOMContentLoaded',initializeCustomerDetail)
