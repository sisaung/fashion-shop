<div class="flex items-center gap-1">
    <div class="flex flex-col ">

        {{-- sort_by ascending --}}
        <a data-sort-direction="asc"
            class="hover:bg-stone-200 duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
            </svg>

        </a>

        {{-- sort_by descending --}}

        <a data-sort-direction="desc" 
            class="hover:bg-stone-200 duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>

        </a>

    </div>
    <span>

        {{ $sortTitle }}

    </span>
</div>

