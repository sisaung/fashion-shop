

const handleSearch = () => {
    

    
    const search = document.querySelector('.search');

    const params = document.location.search;
    const urlSearchParams = new URLSearchParams(params);
    const currentParams = Object.fromEntries(urlSearchParams);
    
            

    const searchValue = urlSearchParams.get('q');

        if(searchValue && searchValue !== '') {

            search.value = searchValue
            console.dir(search);
            

        }

    const handleChange = (e) => {
       
       
        

        if(!e.target.value) {

            console.log(location.origin + location.pathname);
            
            location.href =  location.origin + location.pathname
            
        }

       
        const newParams = {
                    ...currentParams,
                 q:e.target.value
                }

        const queryString = new URLSearchParams(newParams).toString();
       
           location.href = location.origin + location.pathname + "?" + queryString;
           search.value = e.target.value
        
    }


    search.addEventListener('keyup',handleChange);
}

document.addEventListener("DOMContentLoaded", handleSearch);
