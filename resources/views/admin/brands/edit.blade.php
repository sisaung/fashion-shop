@extends('layout.dashboard')

@section('content')
    <div class="py-5 mt-5 bg-white rounded-lg shadow">
        @include('components.admin.breadcrumb', [
            'currentPageTitle' => 'Edit Brand',
            'links' => [['name' => 'Brand List', 'path' => route('brand.index')]],
        ])
        <h1 class="mt-10 text-xl px-5"> Edit Brand </h1>
        <div>


            <form id="edit-form" action="{{ route('brand.update', ['brand' => $brand->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="lg:w-2/6 md:w-1/2  rounded-lg p-8 flex flex-col w-full mt-10 md:mt-0">

                    <div class="relative mb-4">
                        {{-- save current param --}}

                        <input type="hidden" name="sort_by" value="{{ old('sort_by', $sort_by) }}">
                        <input type="hidden" name="sort_direction" value="{{ old('sort_direction', $sort_direction) }}">
                        <input type="hidden" name="limit" value="{{ old('limit', $limit) }}">
                        <input type="hidden" name="page" value="{{ old('page', $page) }}">
                        <input type="hidden" name="q" value="{{ old('page', $q) }}">




                        <label for="brand_name"
                            class="@error('brand_name')
                                text-red-500
                        @enderror leading-7 text-sm text-gray-600">Brand
                            Name</label>
                        <input type="text" id="brand_name" name="brand_name"
                            value="{{ old('brand_name', $brand->brand_name) }}"
                            class="w-full @error('brand_name')
                                is-invalid
                        @enderror bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        @error('brand_name')
                            <p class="text-sm text-red-500"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="relative mb-4">
                        <label for="brand_image" class="block leading-7 text-sm text-gray-600">Brand Image</label>

                        <input type="hidden" name="old_brand_image" value="{{ $brand->brand_image }}">
                        <input type="file" name="brand_image" class="file hidden" accept="image/*">
                        <div class="cursor-pointer upload ">
                            @if ($brand->brand_image)
                                <img name="brand_image" src="{{ $brand->brand_image }}" alt="{{ $brand->brand_name }}"
                                    class="uploaded-image">
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-14 stroke-stone-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                            @endif

                            <p class="text-sm text-gray-600 mt-3"> Click to upload </p>
                        </div>

                    </div>
                    <div class="flex items-center gap-x-5 w-full">
                        <a href="{{ route('brand.index', ['sort_by' => $sort_by, 'sort_direction' => $sort_direction, 'limit' => $limit, 'page' => $page, 'q' => $q]) }}"
                            class="text-stone-500 inline-flex justify-center items-center bg-white py-2 px-8 focus:outline-none hover:bg-pearl-bush-500 hover:text-white border w-1/2 border-pearl-bush-300 rounded text-sm cursor-pointer duration-300">Cancel</a>
                        <button
                            class="text-white bg-pearl-bush-400 border-0 py-2 px-8 focus:outline-none hover:bg-pearl-bush-600 rounded text-sm w-1/2 cursor-pointer duration-300">Update</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    @vite(['resources/js/fileUpload.js'])
@endpush
