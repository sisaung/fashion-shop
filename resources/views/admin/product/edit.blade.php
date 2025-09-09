@extends('layout.dashboard')

@section('content')
    <div class="py-5 mt-5 bg-white rounded-lg shadow">
        <div class="flex justify-between items-center">
            <div>
                @include('components.admin.breadcrumb', [
                    'currentPageTitle' => 'Edit Product',
                    'links' => [['name' => 'Product List', 'path' => route('product.index')]],
                ])
            </div>


            <div class="px-5 flex gap-x-3 justify-center items-center">

                {{-- edit product --}}
                <div>
                    <p
                        class="size-12 inline-flex justify-center items-center border-2 border-pearl-bush-300 bg-pearl-bush-500 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </p>
                </div>

                <div class="border-t-2 border-dashed border-t-pearl-bush-500 w-10"></div>

                {{-- manage product image --}}
                <div>
                    <a href="{{ route('manage-image.edit', ['id' => $product->id]) }}"
                        class="size-12 inline-flex justify-center items-center border border-pearl-bush-600  rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 stroke-pearl-bush-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>

                    </a>
                </div>

                <div class="border-t-2 border-dashed border-t-pearl-bush-500 w-10"></div>

                {{-- manage stock --}}
                <div>
                    <a href="{{ route('manage-stock.create', ['id' => $product->id]) }}"
                        class="size-12 inline-flex justify-center items-center border border-pearl-bush-600 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 stroke-pearl-bush-400">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.429 9.75 2.25 12l4.179 2.25m0-4.5 5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0 4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0-5.571 3-5.571-3" />
                        </svg>

                    </a>
                </div>

                <div class="border-t-2 border-dashed border-t-pearl-bush-500 w-10"></div>


                {{-- product detail --}}

                <div>
                    <a href="{{ route('product.show', ['product' => $product->id]) }}"
                        class="size-12 inline-flex justify-center items-center border border-pearl-bush-600 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 stroke-pearl-bush-400">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>


                    </a>
                </div>

            </div>

        </div>

        <h1 class="mt-5 mb-5 text-xl px-5"> Edit Product </h1>
        <div>
            <form action="{{ route('product.update', ['product' => $product->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-8 gap-5 px-5">

                    {{-- save current param --}}

                    <input type="hidden" name="sort_by" value="{{ old('sort_by', $sort_by) }}">
                    <input type="hidden" name="sort_direction" value="{{ old('sort_direction', $sort_direction) }}">
                    <input type="hidden" name="limit" value="{{ old('limit', $limit) }}">
                    <input type="hidden" name="page" value="{{ old('page', $page) }}">
                    <input type="hidden" name="q" value="{{ old('page', $q) }}">


                    {{-- product code --}}
                    {{-- <div class="relative mb-4 col-span-2">
                        <label for="product_code"
                            class="@error('product_code')
                            text-red-500
                        @enderror leading-7 text-sm text-gray-600">Product
                            Code</label>
                        <span class="text-red-500">*</span>
                        <input type="text" id="product_code" name="product_code"
                            value="{{ old('product_code', $product->product_code) }}"
                            class="@error('product_code')
                            is-invalid
                        @enderror product-code w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        @error('product_code')
                            <p class="text-sm text-red-500"> {{ $message }}</p>
                        @enderror
                    </div> --}}

                    {{-- product name --}}
                    <div class="relative mb-4 col-span-2">
                        <label for="product_name"
                            class="@error('product_name')
                            text-red-500
                        @enderror leading-7 text-sm text-gray-600">Product
                            Name</label>
                        <span class="text-red-500">*</span>

                        <input type="text" id="product_name" name="product_name"
                            value="{{ old('product_name', $product->product_name) }}"
                            class="@error('product_name')
                            is-invalid
                        @enderror w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        @error('product_name')
                            <p class="text-sm text-red-500"> {{ $message }}</p>
                        @enderror
                    </div>


                    <div class="col-span-2"></div>
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
                                <option value="{{ $brand->id }}"
                                    {{ $product->brand_id === $brand->id ? 'selected' : '' }}>
                                    {{ $brand->brand_name }} </option>
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
                                <option value="{{ $productCategory->id }}"
                                    {{ $product->product_category_id === $productCategory->id ? 'selected' : '' }}>
                                    {{ $productCategory->category_name }} </option>
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
                            @if ($product->product_type_id)
                                <option value="{{ $product->product_type_id }}" selected>
                                    {{ $product->productType->name }} </option>
                            @endif

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
                                <option value="" selected class="text-sm text-gray-700">Choose fit</option>
                                @if ($product->fit)
                                    <option value="{{ $product->fit->id }}" selected>{{ $product->fit->fit_name }}
                                    </option>
                                @endif
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

                        <input type="number" id="original-price" name="original_price"
                            value="{{ old('original_price', $product->original_price) }}"
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

                        <input type="number" id="sale-price" name="sale_price"
                            value="{{ old('sale_price', $product->sale_price) }}"
                            class="@error('sale_price')
                            is-invalid
                        @enderror w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        @error('sale_price')
                            <p class="text-sm text-red-500"> {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- discount type --}}
                    <div class="relative mb-4 w-full col-span-2">
                        @php
                            $discountType = ['percentage', 'fixed'];
                            $discount_type = old('discount_type', $product->discount_type);
                        @endphp
                        <label for="discount_type"
                            class="@error('discount_type')
                            text-red-500
                        @enderror leading-7 text-sm text-gray-600">Discount
                            Type </label>


                        <select id="discount-type" name="discount_type"
                            class=" @error('discount_type')
                            is-invalid
                        @enderror block w-full  p-2.5  rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 ">
                            <option selected class="text-sm text-gray-700" value="">Choose Discount Type</option>
                            @foreach ($discountType as $type)
                                <option value="{{ $type }}" @selected($discount_type == $type)>{{ $type }}
                                </option>
                            @endforeach

                        </select>
                        @error('discount_type')
                            <p class="text-sm text-red-500"> {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- discount --}}
                    <div class="relative mb-4 col-span-2">
                        <label for="discount_value"
                            class="@error('discount_value')
                            text-red-500
                        @enderror leading-7 text-sm text-gray-600">Discount</label>
                        <input type="number" id="discount-value" name="discount_value"
                            value="{{ old('discount_value', $product->discount_value) }}"
                            class="@error('discount_value')
                            is-invalid
                        @enderror  w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        @error('discount_value')
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


                        <input readonly type="text" id="display-price" name="display_price"
                            value="{{ old('display_price', $product->display_price) }}"
                            class="@error('display_price')
                            is-invalid
                        @enderror w-full  bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        @error('display_price')
                            <p class="text-sm text-red-500"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2"></div>
                    <div class="col-span-2"></div>
                    <div class="col-span-2"></div>


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
                            {{ old('description', $product->product_description) }}
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
                                    <input @checked(old('gender', $product->gender) === 'male') type="radio"
                                        value="{{ old('gender', $product->gender) }}" id="male"
                                        class="w-4 h-4 border border-pearl-bush-300 text-pearl-bush-600 bg-pearl-bush-50  focus:ring-pearl-bush-500 dark:focus:ring-pearl-bush-600 focus:ring-2 "
                                        name="gender" value="male">

                                </div>

                                <div class="flex gap-x-2 items-center">
                                    <label for="female"> Female </label>
                                    <input type="radio" @checked(old('gender', $product->gender) === 'female')
                                        class="w-4 h-4 text-pearl-bush-600 border-pearl-bush-300 bg-pearl-bush-50-100  focus:ring-pearl-bush-500 dark:focus:ring-pearl-bush-600 focus:ring-2 "
                                        id="female" name="gender" value="female">
                                </div>

                                <div class="flex gap-x-2 items-center">
                                    <label for="unisex"> Unisex </label>
                                    <input type="radio" @checked(old('gender', $product->gender) === 'unisex')
                                        class="w-4 h-4 text-pearl-bush-600 bg-pearl-bush-50 border-pearl-bush-300 focus:ring-pearl-bush-500 dark:focus:ring-pearl-bush-600 focus:ring-2 "
                                        id="unisex" name="gender" value="unisex">
                                </div>
                            </div>

                            @error('gender')
                                <p class="text-sm text-red-500"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-x-2 mt-2 items-center">
                            <input type="checkbox" @checked(old('is_new_arrival', $product->is_new_arrival) == 1)
                                class="text-sm focus:ring-2 focus:ring-pearl-bush-500 font-medium text-pearl-bush-500 "
                                name="is_new_arrival" id="is_new_arrival">
                            <label for="is_new_arrival" class="leading-7 text-sm text-gray-600">New
                                Arrival</label>
                        </div>

                        <div class="flex gap-x-2 mt-2 items-center">
                            <input type="checkbox" @checked(old('is_trending', $product->is_trending) == 1)
                                class="text-sm focus:ring-2 focus:ring-pearl-bush-500 font-medium text-pearl-bush-500 "
                                name="is_trending" id="is_trending">
                            <label for="is_trending" class="leading-7 text-sm text-gray-600">
                                Trendy</label>
                        </div>


                        <div class="flex  gap-x-5  w-full ">
                            <a href="{{ route('product.index', ['sort_by' => $sort_by, 'sort_direction' => $sort_direction, 'limit' => $limit, 'page' => $page, 'q' => $q]) }}"
                                class="text-stone-500 inline-flex justify-center items-center bg-white py-2 px-8 focus:outline-none hover:bg-pearl-bush-500 w-1/2 hover:text-white border  border-pearl-bush-300 rounded text-sm cursor-pointer duration-300">Cancel</a>
                            <button
                                class="text-white bg-pearl-bush-400 border-0 py-2 px-8 focus:outline-none hover:bg-pearl-bush-600 rounded text-sm  cursor-pointer w-1/2 duration-300">Update</button>
                        </div>

                    </div>

                    <div class="col-span-2">
                    </div>
                </div>
        </div>
        </form>
    </div>
    </div>
@endsection
@push('scripts')
    {{-- @vite(['resources/js/fileUpload.js']) --}}
    @vite(['resources/js/filterProductType.js'])
    @vite(['resources/js/filterFit.js'])
    @vite(['resources/js/calculateProFit.js'])
@endpush
