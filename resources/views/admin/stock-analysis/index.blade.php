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
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-4">
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
            <canvas id="sizeStockChart"></canvas>
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/stock-analysis/stockAnalysis.js'])
@endpush
