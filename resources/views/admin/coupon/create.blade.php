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

                <div class=" rounded-lg p-8  mt-10 md:mt-0">

                    <div class="grid grid-cols-4 gap-5">
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
                            <label for="daily_usage"
                                class="@error('daily_usage')
                            text-red-500
                        @enderror leading-7 text-sm text-gray-600">Daily Usage
                                </label>
                            <input type="number" id="daily_usage" name="daily_usage" value="{{ old('daily_usage') }}"
                                class="@error('daily_usage')
                            is-invalid
                        @enderror w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            @error('daily_usage')
                                <p class="text-sm text-red-500"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-1"></div>

                        <div class="relative mb-4 w-full col-span-1">
                            <label for="discount_type"
                                class="@error('discount_type')
                                text-red-500
                            @enderror leading-7 text-sm text-gray-600">Discount
                                Type </label>


                            <select id="discount-type" name="discount_type" value="{{ old('discount_type') }}"
                                class=" @error('discount_type')
                                is-invalid
                            @enderror block w-full  p-2.5  rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 ">
                                <option selected class="text-sm text-gray-700" value="">Choose Discount Type</option>
                                <option value="{{ 'percentage' }}">Percentage</option>
                                <option value="{{ 'fixed' }}">Fixed</option>

                            </select>
                            @error('discount_type')
                                <p class="text-sm text-red-500"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="relative mb-4">
                            <label for="coupon_discount"
                                class="@error('coupon_discount')
                            text-red-500
                        @enderror leading-7 text-sm text-gray-600">Coupon
                                Discount</label>
                            <input type="number" id="coupon_discount" name="coupon_discount"
                                value="{{ old('coupon_discount') }}"
                                class="@error('coupon_discount')
                            is-invalid
                        @enderror w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            @error('coupon_discount')
                                <p class="text-sm text-red-500"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-1"></div>
                        <div class="col-span-1"></div>

                        <div class="relative mb-4 col-span-1">
                            <label for="coupon_start_date"
                                class="@error('coupon_start_date')
                            text-red-500
                        @enderror leading-7 text-sm text-gray-600">Coupon
                                Start Date </label>
                            <input type="date" id="coupon_start_date" name="coupon_start_date"
                                value="{{ old('coupon_start_date') }}"
                                class="@error('coupon_start_date')
                            is-invalid
                        @enderror w-full placeholder:text-gray-400 placeholder:text-sm bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                placeholder="Select Date">
                            @error('coupon_start_date')
                                <p class="text-sm text-red-500"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="relative mb-4 col-span-1">
                            <label for="coupon_expire_date"
                                class="@error('coupon_expire_date')
                            text-red-500
                        @enderror leading-7 text-sm text-gray-600">Coupon
                                Expire Date </label>
                            <input type="date" id="coupon_expire_date" name="coupon_expire_date"
                                value="{{ old('coupon_expire_date') }}"
                                class="@error('coupon_expire_date')
                            is-invalid
                        @enderror w-full placeholder:text-gray-400 placeholder:text-sm bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                placeholder="Select Date">
                            @error('coupon_expire_date')
                                <p class="text-sm text-red-500"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-1"></div>
                        <div class="col-span-1"></div>



                        <div class="flex items-center gap-x-5 w-full">
                            <a href="{{ route('coupon.index') }}"
                                class="text-stone-500 inline-flex justify-center items-center bg-white py-2 px-8 focus:outline-none hover:bg-pearl-bush-500 hover:text-white border w-1/2 border-pearl-bush-300 rounded text-sm cursor-pointer duration-300">Cancel</a>
                            <button
                                class="text-white bg-pearl-bush-400 border-0 py-2 px-8 focus:outline-none hover:bg-pearl-bush-600 rounded text-sm w-1/2 cursor-pointer duration-300">Create</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    {{-- @vite(['resources/js/fileUpload.js']) --}}
    @vite(['resources/js/selectDate.js'])
@endpush
