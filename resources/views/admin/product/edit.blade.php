@extends('layout.dashboard')

@section('content')
    @include('components.admin.breadcrumb', [
        'currentPageTitle' => 'Edit Product Type',
        'links' => [['name' => 'Manage Product Type', 'path' => 'product-type.index']],
    ])
    <h1 class="mt-10 text-xl px-5"> Edit Product Type </h1>
    <div>


        <form id="edit-form" action="{{ route('product-type.update', ['product_type' => $productType->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="px-5 grid grid-cols-6 gap-5">

                <div class="relative mb-4 col-span-2">
                    {{-- save current param --}}

                    <input type="hidden" name="sort_by" value="{{ old('sort_by', $sort_by) }}">
                    <input type="hidden" name="sort_direction" value="{{ old('sort_direction', $sort_direction) }}">
                    <input type="hidden" name="limit" value="{{ old('limit', $limit) }}">
                    <input type="hidden" name="page" value="{{ old('page', $page) }}">
                    <input type="hidden" name="search" value="{{ old('page', $q) }}">

                    <label for="name" class="leading-7 text-sm text-gray-600">Product Type Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $productType->name) }}"
                        class="w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    @error('name')
                        <p class="text-sm text-red-500"> {{ $message }}</p>
                    @enderror
                </div>

                <div class="relative mb-4 w-full col-span-2">
                    <label for="product_category"
                        class="@error('product_category_id')
                            text-red-500
                        @enderror leading-7 text-sm text-gray-600">Product
                        Category </label>

                    <select id="product_category" name="product_category_id"
                        class=" @error('product_category_id')
                            is-invalid
                        @enderror block w-full  p-2.5  rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 ">
                        <option selected class="text-sm text-gray-700">Choose product category</option>
                        @foreach ($productCategories as $productCategory)
                            <option {{ $productCategory->id == $productType->product_category_id ? 'selected' : '' }}
                                value="{{ $productCategory->id }}"> {{ $productCategory->category_name }} </option>
                        @endforeach
                    </select>
                    @error('product_category_id')
                        <p class="text-sm text-red-500"> {{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-2"></div>

                <div class="relative mb-4 fit-tags col-span-3">
                    <label for="fits"
                        class="@error('fits')
                            text-red-500
                        @enderror leading-7 block text-sm text-gray-600">Fit
                        Name</label>

                    {{-- <input type="text" id="fits" name="fits" value="{{ old('fits') }}"
                        class="@error('fits')
                            is-invalid
                        @enderror w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"> --}}

                    <input type="hidden" name="fits" class="fit-hidden"
                        value={{ implode(',', $productType->fits->pluck('id')->toArray()) }}>
                    <div class="inline-flex flex-wrap items-center gap-2 cursor-pointer  text-pearl-bush-400">

                        @if ($fits->count())
                            @foreach ($fits as $fit)
                                <p data-id="{{ $fit->id }}"
                                    class="text-sm text-nowrap border select-none border-pearl-bush-300 fit-tag px-4 py-1.5 rounded-lg">
                                    {{ $fit->fit_name }} </p>
                            @endforeach
                        @else
                            <p class="text-gray-500"> There are no fits. <a href="{{ route('fit.create') }}"
                                    class="text-pearl-bush-500 underline underline-offset-4 hover:text-pearl-bush-600">Add
                                    fit</a> </p>
                        @endif

                    </div>

                    @error('fits')
                        <p class="text-sm text-red-500"> {{ $message }}</p>
                    @enderror
                </div>



                <div class="relative mb-4 size-tags col-span-3">
                    <label for="sizes"
                        class="@error('sizes')
                            text-red-500
                        @enderror  leading-7 block text-sm text-gray-600">Size
                    </label>

                    <input type="hidden" name="sizes"
                        value={{ implode(',', $productType->sizes->pluck('id')->toArray()) }} class="size-hidden">
                    <div class="inline-flex flex-wrap items-center gap-2 cursor-pointer  text-pearl-bush-400">
                        @if ($sizes->count())
                            @foreach ($sizes as $size)
                                <p data-id="{{ $size->id }}"
                                    class="text-sm uppercase text-nowrap border select-none border-pearl-bush-300 size-tag px-4 py-1.5 rounded-lg">
                                    {{ $size->size_name }} </p>
                            @endforeach
                        @else
                            <p class="text-gray-500"> There are no sizes. <a href="{{ route('size.create') }}"
                                    class="text-pearl-bush-500 underline underline-offset-4 hover:text-pearl-bush-600">Add
                                    size</a>
                            </p>
                        @endif
                    </div>

                    {{-- <input type="text" id="sizes" name="sizes" value="{{ old('sizes') }}"
                        class="@error('sizes')
                            is-invalid
                        @enderror w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"> --}}
                    @error('sizes')
                        <p class="text-sm text-red-500"> {{ $message }}</p>
                    @enderror
                </div>
                <div class="col-span-2">
                    <div class="flex items-center gap-x-5 w-full">
                        <a href="{{ route('product-type.index', ['sort_by' => $sort_by, 'sort_direction' => $sort_direction, 'limit' => $limit, 'page' => $page, 'q' => $q]) }}"
                            class="text-stone-500 inline-flex justify-center items-center bg-white py-2 px-8 focus:outline-none hover:bg-pearl-bush-500 hover:text-white border w-1/2 border-pearl-bush-300 rounded text-sm cursor-pointer duration-300">Cancel</a>
                        <button
                            class="text-white bg-pearl-bush-400 border-0 py-2 px-8 focus:outline-none hover:bg-pearl-bush-600 rounded text-sm w-1/2 cursor-pointer duration-300">Update</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
@push('scripts')
    @vite(['resources/js/fitTag.js'])
    @vite(['resources/js/sizeTag.js'])
@endpush
