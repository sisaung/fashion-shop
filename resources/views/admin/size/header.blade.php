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
    <div>
        <a href="{{ route('size.create') }}"
            class="inline-flex items-center gap-x-2 text-sm bg-pearl-bush-400 text-white px-4 py-2 rounded-md cursor-pointer  hover:bg-pearl-bush-500 duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>

            Add Size </a>
    </div>
</div>
