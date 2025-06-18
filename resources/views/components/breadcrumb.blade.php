<nav class="flex" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <li class="inline-flex items-center">
            <a href="/"
                class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-600  ite">

                Home
            </a>
        </li>


        @if (isset($links))
            @foreach ($links as $link)

                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>

                        <a href="{{ $link['path'] }}"
                       class="ms-1 text-sm font-medium
                            text-gray-500 hover:text-gray-600 md:ms-2 ite">
                            {{ $link['name'] }} </a>
                    </div>
                </li>
            @endforeach
        @endif


        <li>
            <div class="flex items-center">
                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
                <p class="ms-1 text-sm font-medium    md:ms-2  ite">
                    <span class="text-gray-700 pr-3">{{ $currentPageTitle }}</span> </p>
                    <span class="text-xs bg-pearl-bush-200  text-pearl-bush-600  px-3 py-1 rounded-full font-medium"> Total Products {{$totalProduct}} </span>
            </div>
        </li>

    </ol>
</nav>
