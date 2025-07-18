<div class="mt-10 px-5 flex justify-between items-center">
    <div>
        <div class="relative  ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor"
                class="size-4.5 stroke-stone-400 absolute top-0
                translate-y-2/3 translate-x-4/5
                z-20 left-0 ">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </div>



        <div class="relative">
            <input type="text" placeholder="search"
                class="search border px-8 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 focus:outline-none border-stone-300 rounded ps-10 py-2 ">
        </div>

    </div>
    <div>
        <button id="dropdownDefaultButton1" data-dropdown-toggle="dropdown1"
            class=" focus:ring-1 cursor-pointer border border-gray-200 bg-gray-50 focus:ring-gray-400  text-gray-800 font-medium rounded-lg text-sm px-4 py-2.5 text-center flex items-center justify-between gap-x-5 "
            type="button">

            <p class="inline-flex items-center gap-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-list-filter group-active:scale-75 duration-300">
                    <path d="M3 6h18"></path>
                    <path d="M7 12h10"></path>
                    <path d="M10 18h4"></path>
                </svg>


                <span class="filter-payment">Filter</span>
            </p>

            <p>
                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </p>
        </button>
    </div>

    <div id="dropdown1"
        class="z-20 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-52 dark:bg-gray-700">
        <div class="sort-product py-2 text-sm text-gray-700 " aria-labelledby="dropdownDefaultButton1">

            @foreach (['Paid', 'Unpaid', 'Pending', 'Confirmed', 'Delivered', 'Completed', 'Cancelled'] as $payment)
                <button data-payment="{{ $payment }}"
                    class="filter-payment-btn inline-block text-start cursor-pointer w-full  px-4 py-2 hover:bg-gray-100 ">
                    {{ $payment }} </button>
            @endforeach

        </div>
    </div>
</div>
