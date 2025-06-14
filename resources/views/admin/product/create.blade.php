@extends('layout.dashboard')

@section('content')
    @include('components.admin.breadcrumb', [
        'currentPageTitle' => 'Create Product',
        'links' => [['name' => 'Manage Product', 'path' => 'product.index']],
    ])
    <h1 class="mt-10 text-xl px-5"> Create Product </h1>
    <div>
        <form action="{{ route('product.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-8 gap-5 px-5">

                {{-- product code --}}
                <div class="relative mb-4 col-span-2">
                    <label for="product_code"
                        class="@error('product_code')
                            text-red-500
                        @enderror leading-7 text-sm text-gray-600">Product
                        Code</label>
                    <span class="text-red-500">*</span>
                    <input type="text" id="product_code" name="product_code" value="{{ old('product_code') }}"
                        class="@error('product_code')
                            is-invalid
                        @enderror product-code w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    @error('product_code')
                        <p class="text-sm text-red-500"> {{ $message }}</p>
                    @enderror
                </div>

                {{-- product name --}}
                <div class="relative mb-4 col-span-2">
                    <label for="product_name"
                        class="@error('product_name')
                            text-red-500
                        @enderror leading-7 text-sm text-gray-600">Product
                        Name</label>
                    <span class="text-red-500">*</span>

                    <input type="text" id="product_name" name="product_name" value="{{ old('product_name') }}"
                        class="@error('product_name')
                            is-invalid
                        @enderror w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    @error('product_name')
                        <p class="text-sm text-red-500"> {{ $message }}</p>
                    @enderror
                </div>



                <div class="col-span-2"></div>
                <div class="col-span-2"></div>


                {{-- brand --}}
                <div class="relative mb-4 w-full col-span-2">
                    <label for="brand"
                        class="@error('brand_id')
                            text-red-500
                        @enderror leading-7 text-sm text-gray-600">Brand
                        Name
                    </label>
                    <span class="text-red-500">*</span>


                    <select id="brand" name="brand_id"
                        class=" @error('brand_id')
                            is-invalid
                        @enderror block w-full  p-2.5  rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 ">
                        <option selected class="text-sm text-gray-700">Choose brand</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}"> {{ $brand->brand_name }} </option>
                        @endforeach
                    </select>
                    @error('brand_id')
                        <p class="text-sm text-red-500"> {{ $message }}</p>
                    @enderror
                </div>

                {{-- category --}}
                <div class="relative mb-4 w-full col-span-2">
                    <label for="product_category"
                        class="@error('product_category_id')
                            text-red-500
                        @enderror leading-7 text-sm text-gray-600">Product
                        Category </label>
                    <span class="text-red-500">*</span>

                    <select id="product_category" name="product_category_id"
                        class=" @error('product_category_id')
                            is-invalid
                        @enderror block w-full  p-2.5  rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 ">
                        <option selected class="text-sm text-gray-700">Choose product category</option>
                        @foreach ($productCategories as $productCategory)
                            <option value="{{ $productCategory->id }}"> {{ $productCategory->category_name }} </option>
                        @endforeach
                    </select>
                    @error('product_category_id')
                        <p class="text-sm text-red-500"> {{ $message }}</p>
                    @enderror
                </div>

                <input type="hidden" class="select-product-category-id">

                {{-- product type --}}
                <div id="product-type-container" class="relative mb-4 w-full col-span-2 ">
                    <label for="product_type"
                        class="@error('product_type_id')
                            text-red-500
                        @enderror leading-7 text-sm text-gray-600">Product
                        Type </label>
                    <span class="text-red-500">*</span>


                    <select id="product_type" name="product_type_id"
                        class=" @error('product_type_id')
                            is-invalid
                        @enderror block w-full  p-2.5  rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 ">
                        <option selected class="text-sm text-gray-700">Choose product type</option>

                    </select>
                    @error('product_type_id')
                        <p class="text-sm text-red-500"> {{ $message }}</p>
                    @enderror
                </div>

                {{-- fit --}}

                <div id="fit-container" class="relative mb-4 w-full col-span-2">
                    <div id="fit-group">
                        <label for="fit"
                            class="@error('fit_id')
                            text-red-500
                        @enderror leading-7 text-sm text-gray-600">Fit
                            type
                        </label>
                        <span class="text-red-500">*</span>

                        <select id="fit" name="fit_id"
                            class=" @error('fit_id')
                            is-invalid
                        @enderror block w-full  p-2.5  rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 ">
                            <option selected class="text-sm text-gray-700" value="">Choose fit</option>
                        </select>
                        @error('fit_id')
                            <p class="text-sm text-red-500"> {{ $message }}</p>
                        @enderror
                    </div>
                </div>



                {{-- original price --}}
                <div class="relative mb-4 col-span-2">
                    <label for="original_price"
                        class="@error('original_price')
                            text-red-500
                        @enderror leading-7 text-sm text-gray-600">Original
                        Price</label>
                    <span class="text-red-500">*</span>

                    <input type="number" id="original-price" name="original_price" value="{{ old('original_price') }}"
                        class="@error('original_price')
                            is-invalid
                        @enderror w-full original-price bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    @error('original_price')
                        <p class="text-sm text-red-500"> {{ $message }}</p>
                    @enderror
                </div>

                {{-- sale price --}}
                <div class="relative mb-4 col-span-2">
                    <label for="sale_price"
                        class="@error('sale_price')
                            text-red-500
                        @enderror leading-7 text-sm text-gray-600">Sale
                        Price</label>
                    <span class="text-red-500">*</span>

                    <input type="number" id="sale-price" name="sale_price" value="{{ old('sale_price') }}"
                        class="@error('sale_price')
                            is-invalid
                        @enderror w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    @error('sale_price')
                        <p class="text-sm text-red-500"> {{ $message }}</p>
                    @enderror
                </div>

                {{-- discount --}}
                <div class="relative mb-4 col-span-2">
                    <label for="discount_percentage"
                        class="@error('discount_percentage')
                            text-red-500
                        @enderror leading-7 text-sm text-gray-600">Discount</label>
                    <input type="number" id="discount-percentage" name="discount_percentage"
                        value="{{ old('discount_percentage') }}"
                        class="@error('discount_percentage')
                            is-invalid
                        @enderror  w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    @error('discount_percentage')
                        <p class="text-sm text-red-500"> {{ $message }}</p>
                    @enderror
                </div>

                {{-- display price --}}
                <div class="relative mb-4 col-span-2">
                    <label for="display_price"
                        class="@error('display_price')
                            text-red-500
                        @enderror leading-7 text-sm text-gray-600">Display
                        Price</label>

                    <span class="profit text-green-500 text-sm ml-2"> </span>

                    <input readonly type="text" id="display-price" name="display_price" value="{{ old('display_price') }}"
                        class="@error('display_price')
                            is-invalid
                        @enderror w-full  bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    @error('display_price')
                        <p class="text-sm text-red-500"> {{ $message }}</p>
                    @enderror
                </div>

                {{-- description --}}
                <div class="relative mb-4 col-span-4">
                    <label for="description"
                        class="@error('description')
                            text-red-500
                        @enderror leading-7 text-sm text-gray-600">Description
                    </label>

                    <textarea
                        class="w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                        name="description" id="" cols="30" rows="7">

                        </textarea>
                    @error('description')
                        <p class="text-sm text-red-500"> {{ $message }}</p>
                    @enderror
                </div>

                <div class="relative mb-4 col-span-2 flex flex-col mt-auto gap-5">
                    <div>
                        <label for="gender"
                            class="@error('gender')
                        text-red-500
                    @enderror leading-7 text-sm text-gray-600">Gender</label>
                        <span class="text-red-500">*</span>


                        <div class="flex gap-x-5">
                            <div class="flex gap-x-2 items-center">
                                <label for="male"> Male </label>
                                <input type="radio" id="male"
                                    class="w-4 h-4 border border-pearl-bush-300 text-pearl-bush-600 bg-pearl-bush-50  focus:ring-pearl-bush-500 dark:focus:ring-pearl-bush-600 focus:ring-2 "
                                    name="gender" value="male">

                            </div>

                            <div class="flex gap-x-2 items-center">
                                <label for="female"> Female </label>
                                <input type="radio"
                                    class="w-4 h-4 text-pearl-bush-600 border-pearl-bush-300 bg-pearl-bush-50-100  focus:ring-pearl-bush-500 dark:focus:ring-pearl-bush-600 focus:ring-2 "
                                    id="female" name="gender" value="female">
                            </div>

                            <div class="flex gap-x-2 items-center">
                                <label for="unisex"> Unisex </label>
                                <input type="radio"
                                    class="w-4 h-4 text-pearl-bush-600 bg-pearl-bush-50 border-pearl-bush-300 focus:ring-pearl-bush-500 dark:focus:ring-pearl-bush-600 focus:ring-2 "
                                    id="unisex" name="gender" value="unisex">
                            </div>
                        </div>

                        @error('gender')
                            <p class="text-sm text-red-500"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-x-2 mt-2 items-center">
                        <input type="checkbox"
                            class="text-sm focus:ring-2 focus:ring-pearl-bush-500 font-medium text-pearl-bush-500 "
                            name="is_new_arrival" id="is_new_arrival">
                        <label for="is_new_arrival" class="leading-7 text-sm text-gray-600">New
                            Arrival</label>
                    </div>


                    {{-- create --}}
                    <div class="flex  gap-x-5  w-full ">
                        <a href="{{ route('product.index') }}"
                            class="text-stone-500 inline-flex justify-center items-center bg-white py-2 px-8 focus:outline-none hover:bg-pearl-bush-500 w-1/2 hover:text-white border  border-pearl-bush-300 rounded text-sm cursor-pointer duration-300">Cancel</a>
                        <button
                            class="text-white bg-pearl-bush-400 border-0 py-2 px-8 focus:outline-none hover:bg-pearl-bush-600 rounded text-sm  cursor-pointer w-1/2 duration-300">Create</button>
                    </div>

                </div>

                <div class="col-span-2">
                </div>
            </div>
    </div>
    </form>
    </div>
@endsection
@push('scripts')
    {{-- @vite(['resources/js/fileUpload.js']) --}}
    @vite(['resources/js/filterProductType.js'])
    @vite(['resources/js/filterFit.js'])
    @vite(['resources/js/calculateProFit.js'])
@endpush
