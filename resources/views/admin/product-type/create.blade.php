@extends('layout.dashboard')

@section('content')
    <div class="py-5 mt-5 bg-white rounded-lg shadow">
        @include('components.admin.breadcrumb', [
            'currentPageTitle' => 'Create Product Type',
            'links' => [['name' => 'Product Type', 'path' => route('product-type.index')]],
        ])
        <h1 class="mt-5 mb-5 text-xl px-5"> Create Product Type </h1>
        <div>
            <form action="{{ route('product-type.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-6 gap-5 px-5">

                    <div class="relative mb-4 col-span-2">
                        <label for="name"
                            class="@error('name')
                            text-red-500
                        @enderror leading-7 text-sm text-gray-600">Product
                            Type Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="@error('name')
                            is-invalid
                        @enderror w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
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
                                <option value="{{ $productCategory->id }}"> {{ $productCategory->category_name }} </option>
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

                        <input type="hidden" name="fits" class="fit-hidden">
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

                        <input type="hidden" name="sizes" class="size-hidden">
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
                        <div class="flex  gap-x-5  w-full ">
                            <a href="{{ route('product-type.index') }}"
                                class="text-stone-500 inline-flex justify-center items-center bg-white py-2 px-8 focus:outline-none hover:bg-pearl-bush-500 w-1/2 hover:text-white border  border-pearl-bush-300 rounded text-sm cursor-pointer duration-300">Cancel</a>
                            <button
                                class="text-white bg-pearl-bush-400 border-0 py-2 px-8 focus:outline-none hover:bg-pearl-bush-600 rounded text-sm  cursor-pointer w-1/2 duration-300">Create</button>
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>
    </div>
@endsection
@push('scripts')
    {{-- @vite(['resources/js/fileUpload.js']) --}}
    @vite(['resources/js/fitTag.js'])
    @vite(['resources/js/sizeTag.js'])
@endpush
