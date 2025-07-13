<div class="mt-10 px-5 flex justify-between items-center">
    <div>
        <div class="relative bg-red-600 ">
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

    <div class="flex items-center gap-x-3">
        <button id="dropdownDefaultButton1" data-dropdown-toggle="dropdown1"
            class=" focus:ring-1 border border-gray-200 bg-gray-50 focus:ring-gray-400  text-gray-800 font-medium rounded-lg text-sm px-4 py-2.5 text-center flex items-center justify-between gap-x-5 "
            type="button">

            <p class="inline-flex items-center gap-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                </svg>


                <span class="filter">Category</span>
            </p>

            <p>
                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </p>
        </button>


        <a href="{{ route('product.create') }}"
            class="inline-flex items-center gap-x-2 text-sm bg-pearl-bush-400 text-white px-4 py-2 rounded-md cursor-pointer  hover:bg-pearl-bush-500 duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>

            Add Product </a>
    </div>
</div>
<div id="dropdown1" class="z-20 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-40 dark:bg-gray-700">
    <div class="sort-product py-2 text-sm text-gray-700 " aria-labelledby="dropdownDefaultButton1">

        @foreach ($productCategory as $category)
            <button data-category-name="{{ $category->category_name }}"
                class="filter-category-btn inline-block text-start cursor-pointer w-full  px-4 py-2 hover:bg-gray-100 "> {{ $category->category_name }} </button>
        @endforeach

    </div>
</div>
@push('scripts')
    @vite(['resources/js/filterProductList.js'])
@endpush
