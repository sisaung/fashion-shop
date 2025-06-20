@php
    $brands = [
        ['brand_name' => 'Boss', 'brand_image' => null],
        ['brand_name' => 'Gucci', 'brand_image' => null],
        ['brand_name' => 'Prada', 'brand_image' => null],
        ['brand_name' => 'Louis Vuitton', 'brand_image' => null],
        ['brand_name' => 'Chanel', 'brand_image' => null],
        ['brand_name' => 'Dior', 'brand_image' => null],
    ];
@endphp

<aside id="sidebar"
    class="fixed mt-10 lg:sticky top-0 left-0 z-50 lg:z-0 w-80 lg:w-64 h-full lg:h-auto bg-white rounded-md transform transition-transform duration-300 ease-in-out
    {{ request()->query('sidebar', true) ? 'translate-x-0' : '-translate-x-full lg:translate-x-0' }}
    overflow-y-auto">
    <div class="p-6">
        {{-- Mobile Header --}}
        <div class="lg:hidden flex items-center justify-between mb-6">
            <h2 class="text-lg  text-gray-900">Filters</h2>
            <button id="closeSidebar" class="p-2 text-gray-600 hover:text-gray-900">
                ✕
            </button>
        </div>

        {{-- Availability Filter --}}
        <div class="mb-8">
            <button type="button" class="filter-toggle w-full text-left flex justify-between items-center"
                data-target="availability">
                <h3 class="text-sm  text-gray-600 font-heading  uppercase tracking-wide">Availability</h3>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5 text-gray-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </span>


            </button>

            <div id="filter-availability" class="mt-4 hidden">
                <label class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input type="checkbox" name="in_stock_only" id="inStockOnly" class="sr-only"
                            {{ request('in_stock_only') ? 'checked' : '' }} />
                        <div id="stockToggleBg" class="w-10 h-6 rounded-full transition-colors bg-gray-300">
                            <div id="stockToggleDot"
                                class="absolute top-1 left-1 w-4 h-4 bg-white rounded-full transition-transform"></div>
                        </div>
                    </div>
                    <span class="ml-3 text-sm text-gray-700">In stock only</span>
                </label>
            </div>
        </div>

        {{-- Brand Filter --}}
        <div>
            <button type="button" class="filter-toggle w-full text-left flex justify-between items-center"
                data-target="brand">
                <h3 class="text-sm  text-gray-600 font-heading uppercase tracking-wide">Brand</h3>
                <span id="chevron-availability" class="chevron">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5 text-gray-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </span>

            </button>

            <div id="filter-brand" class="mt-4 space-y-3 hidden">
                @foreach ($brands as $brand)
                    <label class="flex items-center cursor-pointer group">
                        <input type="checkbox" name="brands[]" value="{{ $brand['brand_name'] }}"
                            {{ in_array($brand['brand_name'], request()->get('brands', [])) ? 'checked' : '' }}
                            class="w-4 h-4 text-gray-900 border-gray-300 rounded focus:ring-gray-900 focus:ring-2" />
                        <span class="ml-3 text-sm text-gray-700 group-hover:text-gray-900 transition-colors">
                            {{ $brand['brand_name'] }} (6)
                        </span>
                    </label>
                @endforeach
            </div>
        </div>
    </div>
</aside>
@push('scripts')
    @vite(['resources/js/sidebar/toggleSidebar.js'])
@endpush
