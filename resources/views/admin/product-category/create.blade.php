@extends('layout.dashboard')

@section('content')
    @include('components.admin.breadcrumb', [
        'currentPageTitle' => 'Create Product Category',
        'links' => [['name' => 'Product Category', 'path' => route('product-category.index')]],
    ])
    <h1 class="mt-10 text-xl px-5"> Create Product Category </h1>
    <div>
        <form action="{{ route('product-category.store') }}" method="POST">
            @csrf

            <div class="lg:w-2/6 md:w-1/2  rounded-lg p-8 flex flex-col w-full mt-10 md:mt-0">

                <div class="relative mb-4">
                    <label for="category_name" class="@error('category_name')
                        text-red-500
                        @enderror leading-7 text-sm text-gray-600">Product Category Name</label>
                    <input type="text" id="category_name" name="category_name" value="{{ old('category_name') }}"
                        class="w-full @error('category_name')
                        is-invalid
                        @enderror bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    @error('category_name')
                        <p class="text-sm text-red-500"> {{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-x-5 w-full">
                    <a href="{{ route('product-category.index') }}"
                        class="text-stone-500 inline-flex justify-center items-center bg-white py-2 px-8 focus:outline-none hover:bg-pearl-bush-500 hover:text-white border w-1/2 border-pearl-bush-300 rounded text-sm cursor-pointer duration-300">Cancel</a>
                    <button
                        class="text-white bg-pearl-bush-400 border-0 py-2 px-8 focus:outline-none hover:bg-pearl-bush-600 rounded text-sm w-1/2 cursor-pointer duration-300">Create</button>
                </div>

            </div>
        </form>
    </div>
@endsection
@push('scripts')
    {{-- @vite(['resources/js/fileUpload.js']) --}}
@endpush
