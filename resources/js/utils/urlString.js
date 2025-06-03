  const urlString = (sortBy,sortDirection,q) => {
        
        const params = document.location.search;
        const urlSearchParams = new URLSearchParams(params);
        const currentParams = Object.fromEntries(urlSearchParams);

        const newParams = {
                    ...currentParams,
                    sort_by:sortBy,
                    sort_direction:sortDirection
                }
            


        const queryString = new URLSearchParams(newParams).toString();
       
        return  location.origin + location.pathname + "?" + queryString
        

    }

    export default urlString