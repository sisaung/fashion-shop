<section class="mt-8 px-5">
    <div class="flex flex-col md:flex-row items-center justify-between mt-6 gap-4">
        <!-- Info text -->


        <!-- Custom Pagination -->
        @if ($paginator->hasPages())
            <div class="inline-flex items-center gap-1">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="px-2 py-1 text-sm text-gray-400  rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>

                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}"
                        class="px-2 py-1 text-sm hover:text-pearl-bush-600 text-pearl-bush-500 rounded-md">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>

                    </a>
                    <a href="{{ $paginator->url(1) }}" class="px-2 py-1 text-sm text-pearl-bush-500 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m18.75 4.5-7.5 7.5 7.5 7.5m-6-15L5.25 12l7.5 7.5" />
                        </svg>


                    </a>
                @endif

                {{-- Page Numbers --}}



                @foreach ($paginator->getUrlRange($paginator->currentPage() <= 3 ? 1 : $paginator->currentPage() - 3, $paginator->currentPage() >= $paginator->lastPage() - 2 ? $paginator->lastPage() : $paginator->currentPage() + 3) as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span
                            class="size-8 inline-flex justify-center items-center rounded-full text-sm font-bold text-white bg-pearl-bush-300">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}"
                            class="size-8 inline-flex justify-center items-center rounded-full text-sm text-gray-700 hover:bg-gray-200">{{ $page }}</a>
                    @endif
                @endforeach



                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->url($paginator->lastPage()) }}"
                        class="px-2 py-1 text-sm text-pearl-bush-500  rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                        </svg>


                    </a>

                    <a href="{{ $paginator->nextPageUrl() }}"
                        class="px-2 py-1 text-sm hover:text-pearl-bush-600 text-pearl-bush-500  rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg></a>
                @else
                    <span class=" py-1 text-sm text-gray-400 px-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>

                    </span>
                @endif
            </div>
        @endif
    </div>

</section>
