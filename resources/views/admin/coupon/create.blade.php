@extends('layout.dashboard')

@section('content')
    <div class="py-5 mt-5 bg-white rounded-lg shadow">
        @include('components.admin.breadcrumb', [
            'currentPageTitle' => 'Create Coupon',
            'links' => [['name' => 'Coupon List', 'path' => route('coupon.index')]],
        ])
        <h1 class="mt-10 text-xl px-5"> Create Coupon </h1>
        <div>
            <form action="{{ route('coupon.store') }}" method="POST">
                @csrf

                <div class="lg:w-2/6 md:w-1/2  rounded-lg p-8 flex flex-col w-full mt-10 md:mt-0">

                    <div class="relative mb-4">
                        <label for="coupon_title"
                            class="@error('coupon_title')
                            text-red-500
                        @enderror leading-7 text-sm text-gray-600">Coupon
                            Title</label>
                        <input type="text" id="coupon_title" name="coupon_title" value="{{ old('coupon_title') }}"
                            class="@error('coupon_title')
                            is-invalid
                        @enderror w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        @error('coupon_title')
                            <p class="text-sm text-red-500"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="relative mb-4">
                        <label for="coupon_code"
                            class="@error('coupon_code')
                            text-red-500
                        @enderror leading-7 text-sm text-gray-600">Coupon
                            Code</label>
                        <input type="text" id="coupon_code" name="coupon_code" value="{{ old('coupon_code') }}"
                            class="@error('coupon_code')
                            is-invalid
                        @enderror w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        @error('coupon_code')
                            <p class="text-sm text-red-500"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="relative mb-4">
                        <label for="coupon_discount"
                            class="@error('coupon_discount')
                            text-red-500
                        @enderror leading-7 text-sm text-gray-600">Coupon
                            Discount</label>
                        <input type="text" id="coupon_discount" name="coupon_discount"
                            value="{{ old('coupon_discount') }}"
                            class="@error('coupon_discount')
                            is-invalid
                        @enderror w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        @error('coupon_discount')
                            <p class="text-sm text-red-500"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="relative mb-4">
                        <label for="coupon_expire_date"
                            class="@error('coupon_expire_date')
                            text-red-500
                        @enderror leading-7 text-sm text-gray-600">Coupon
                            Expire Date </label>
                        <input type="date" id="coupon_expire_date" name="coupon_expire_date"
                            value="{{ old('coupon_expire_date') }}"
                            class="@error('coupon_expire_date')
                            is-invalid
                        @enderror w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        @error('coupon_expire_date')
                            <p class="text-sm text-red-500"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-x-5 w-full">
                        <a href="{{ route('coupon.index') }}"
                            class="text-stone-500 inline-flex justify-center items-center bg-white py-2 px-8 focus:outline-none hover:bg-pearl-bush-500 hover:text-white border w-1/2 border-pearl-bush-300 rounded text-sm cursor-pointer duration-300">Cancel</a>
                        <button
                            class="text-white bg-pearl-bush-400 border-0 py-2 px-8 focus:outline-none hover:bg-pearl-bush-600 rounded text-sm w-1/2 cursor-pointer duration-300">Create</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    {{-- @vite(['resources/js/fileUpload.js']) --}}
@endpush
