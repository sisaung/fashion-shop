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
            <div class="lg:w-2/6 md:w-1/2  rounded-lg p-8 flex flex-col w-full mt-10 md:mt-0">

                <div class="relative mb-4">
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

                <div class="relative mb-10">
                    <label for="product_category" class="leading-7 text-sm text-gray-600">Product Category </label>

                    <select id="product_category" name="product_category_id"
                        class=" block w-full p-2.5 bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 ">
                        <option selected class="text-sm text-gray-700">Choose product category</option>
                        @foreach ($productCategories as $productCategory)
                            <option value="{{ $productCategory->id }}"
                                selected={{ $productCategory->id === $productType->product_category_id }}>
                                {{ $productCategory->category_name }} </option>
                        @endforeach
                    </select>
                    @error('product_category_id')
                        <p class="text-sm text-red-500"> {{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-x-5 w-full">
                    <a href="{{ route('product-type.index', ['sort_by' => $sort_by, 'sort_direction' => $sort_direction, 'limit' => $limit, 'page' => $page, 'q' => $q]) }}"
                        class="text-stone-500 inline-flex justify-center items-center bg-white py-2 px-8 focus:outline-none hover:bg-pearl-bush-500 hover:text-white border w-1/2 border-pearl-bush-300 rounded text-sm cursor-pointer duration-300">Cancel</a>
                    <button
                        class="text-white bg-pearl-bush-400 border-0 py-2 px-8 focus:outline-none hover:bg-pearl-bush-600 rounded text-sm w-1/2 cursor-pointer duration-300">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    @vite(['resources/js/fileUpload.js'])
@endpush
