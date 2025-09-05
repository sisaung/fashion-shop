
const initializeCurrentParam = () => {

  const currentUrl = location.search;
  const container = document.querySelector('.body-container');

  if(!container) return ;


  const handleClick = (e) => {
    e.preventDefault();
    // e.stopPropagation();

    const editUrl = e.target.closest('[data-edit-url]')
    if(editUrl) {

        const action = editUrl.dataset.editUrl;

   location.href = `${action}${currentUrl}`


    }



  }

  container.addEventListener("click",handleClick)



}

document.addEventListener('DOMContentLoaded',initializeCurrentParam)
