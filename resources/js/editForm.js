import ajax from "./utils/ajax";

const initializeEditForm = () => {
    const brand = document.querySelector('.brand');
    if(!brand) return;
     const handleEditForm = (e) => {
        
        const link = e.target.closest('[edit-link]');
        console.log(link);
        
       
        if(link) {
            
            e.preventDefault();
            const url = link.getAttribute('href');
        
            
           
            console.log(url);
            const renderSelector = document.querySelector('[edit-link]'); 
          
            renderSelector.innerHTML = 'hello'
                 
            
            // ajax(url, '#edit-form-container', renderSelector); 
            }
        

    }

    brand.addEventListener('click',handleEditForm)
}

document.addEventListener('DOMContentLoaded',initializeEditForm)