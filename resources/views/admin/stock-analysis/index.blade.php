@extends('layout.dashboard')

@section('content')
    <div class="py-5 mt-5 bg-white rounded-lg shadow">


        @include('components.admin.breadcrumb', [
            'currentPageTitle' => 'Stock Analysis',
        ])


        <div class="grid grid-cols-3 gap-3 px-5 mt-5">
            <div class="border border-gray-100">
                <div class="col-span-1 p-5">

                    {{-- header --}}
                    <div class="flex justify-between items-center mb-5">
                        <div class="text-stone-500">Stock by Product Type</div>
                        <div class="hidden clear-stock-by-product-type">
                            <button
                                class="inline-flex items-center gap-x-2 bg-red-100 text-red-400 text-xs px-3 py-1 rounded-lg cursor-pointer hover:bg-red-200">Clear
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="size-4">
                                    <path
                                        d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                                </svg>

                            </button>
                        </div>
                    </div>

                    {{-- stock by product type --}}

                    <template id="stock-by-product-type-template">
                        <div
                            class="stock-by-product-type-btn  cursor-pointer border text-stone-600 rounded-md border-gray-100 px-3 py-2 flex justify-between items-center">
                            <p class="text-sm product-type-name"> Polo Shirt </p>
                            <p class="text-sm total-product-type-stock">343</p>
                        </div>
                    </template>



                    <div class="stock-by-product-type-container grid grid-cols-2 gap-3"></div>


                </div>


            </div>

            {{-- stock by brand --}}
            <div class="border border-gray-100">
                <div class="col-span-1 p-5">

                    {{-- header --}}
                    <div class="flex justify-between items-center mb-5">
                        <div class="text-stone-500">Stock by Brand</div>
                        <div class="clear-stock-by-brand hidden">
                            <button
                                class="inline-flex items-center gap-x-2 bg-red-100 text-red-400 text-xs px-3 py-1 rounded-lg cursor-pointer hover:bg-red-200">Clear
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="size-4">
                                    <path
                                        d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                                </svg>

                            </button>
                        </div>
                    </div>



                    <template id="stock-by-brand-template">
                        <div
                            class="stock-by-brand-btn cursor-pointer border text-stone-600 rounded-md border-gray-100 px-3 py-2 flex justify-between items-center">
                            <p class="text-sm brand-name"></p>
                            <p class="text-sm total-brand-stock"></p>
                        </div>
                    </template>



                    <div class="stock-by-brand-container grid grid-cols-2 gap-3"></div>


                </div>
            </div>


            {{-- stock by size --}}

        </div>


        <div class="px-5">
            <h1 class="mt-5 text-stone-500">Stock by size with category and brand filtered</h1>
            <canvas id="sizeStockChart"></canvas>
        </div>

        <div class="grid grid-cols-2 p-5 gap-5">
            <div class="flex justify-between items-center gap-3">



                {{-- pie chart --}}
                <div>
                    <canvas id="categoryStockChart" width="300" height="300"></canvas>
                </div>
                <div class=" w-full">

                    <div class="w-full space-y-3">
                        <div class="mb-3">
                            <p class="text-end text-sm text-gray-400">Stock Total</p>
                            <div class="flex justify-end border-b border-gray-200 pb-3 ">
                                <p class="font-heading text-2xl stock-total font-semibold">0</p>
                            </div>
                        </div>

                        <div class="total-stock-by-category-container space-y-3"></div>

                    </div>

                    {{-- template stock by category --}}

                    <template id="total-stock-by-category-template">
                        <div class="flex items-center pb-1.5 gap-x-1 last:pb-0 last:border-0 border-b border-gray-200">
                            <div class="size-4 color-dot rounded-full"></div>
                            <div class="flex justify-between items-center w-full">
                                <p class="text-sm text-gray-500 stock-category-label">Clothings</p>
                                <p class="text-xl font-heading text-gray-500 stock-total-category">1000</p>
                            </div>
                        </div>
                    </template>

                </div>

            </div>
            <div>

                <div class="flex flex-col gap-3">
                    {{-- total sale price --}}
                    <div class="border border-gray-100 rounded-lg p-4 flex flex-col items-end ">
                        <h3 class="text-gray-400 text-sm"> Total Sale Price </h3>
                        <p class="font-heading text-2xl total-sale-price"> 0 </p>
                    </div>

                    {{-- total original price --}}
                    <div class="border border-gray-100 rounded-lg p-4 flex flex-col items-end ">
                        <h3 class="text-gray-400 text-sm"> Total Original Price </h3>
                        <p class="font-heading text-2xl total-original-price"> 0 </p>
                    </div>

                    {{-- total profit --}}
                    <div class="border border-pearl-bush-200 bg-pearl-bush-50 rounded-lg p-4 flex flex-col items-end ">
                        <h3 class="text-gray-400 text-sm"> Total Profit </h3>
                        <p class="font-heading text-2xl total-profit"> 0 </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/stock-analysis/stockAnalysis.js'])
@endpush
