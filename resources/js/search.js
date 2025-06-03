const handleSearch = () => {
    const search = document.querySelector(".search");
    search.focus();

    const params = document.location.search;
    const urlSearchParams = new URLSearchParams(params);
    const currentParams = Object.fromEntries(urlSearchParams);

    const searchValue = urlSearchParams.get("q");

    if (searchValue) {
        search.value = searchValue;
                const clearBtn = document.createElement("button");
                clearBtn.innerHTML = ` <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3 stroke-2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
        `;
                clearBtn.classList.add("clear-search");
                clearBtn.addEventListener("click", () => {
                    search.value = "";
                    location.href = location.origin + location.pathname;
                });
                search.parentNode.appendChild(clearBtn);
                console.dir(search);
    }

    const handleChange = (e) => {
        if (e.target.value) {
            const newParams = {
                // ...currentParams,
                q: e.target.value,
            };

            const queryString = new URLSearchParams(newParams).toString();

            location.href =
                location.origin + location.pathname + "?" + queryString;
        } else {
            console.log(location.origin + location.pathname);

            location.href = location.origin + location.pathname;
        }
    };

    const handleKeyUp = (e) => {
        if (e.target.value) {
            search.value = e.target.value;
//             const clearBtn = document.createElement("button");
//             clearBtn.innerHTML = ` <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3 stroke-2">
//   <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
// </svg>
// `;
//             clearBtn.classList.add("clear-search");
//             clearBtn.addEventListener("click", () => {
//                 search.value = "";
//                 location.href = location.origin + location.pathname;
//             });
//             search.parentNode.appendChild(clearBtn);
//             console.dir(search);
//         }
        }
    };

    search.addEventListener("change", handleChange);
    search.addEventListener("keyup", handleKeyUp);
};

document.addEventListener("DOMContentLoaded", handleSearch);
