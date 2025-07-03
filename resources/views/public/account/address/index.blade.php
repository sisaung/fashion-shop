
@extends('components.public.accountLayout')
@section('container')
    <div class="px-5">
        <div class="mt-5 flex items-center gap-x-2 mb-5">
            <p class="font-heading text-stone-600"> Manaage Address </p>
            <button data-modal-target="small-modal" data-modal-toggle="small-modal"
                class="text-sm font-medium bg-pearl-bush-400 text-white py-2 px-4 rounded-full cursor-pointer  hover:bg-pearl-bush-500 duration-300">
                Add New Address</button>
        </div>

        {{-- modal for new address --}}
        <div id="small-modal" tabindex="-1"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm ">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t  border-gray-200">
                        <h3 class="text-xl font-heading font-medium text-stone-800 ">
                            Add New Address
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-full text-sm size-8 ms-auto inline-flex justify-center items-center "
                            data-modal-hide="small-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form action="{{ route('account.storeAdress') }}" method="POST">
                        @csrf

                        <div class="p-4 md:p-5 space-y-4">

                            <div class="space-y-2">
                                <label for="phone_number"
                                    class="@error('phone_number')
                                text-red-500
                            @enderror leading-7 text-sm text-gray-600">Phone
                                    Number
                                </label>
                                <span class="text-gray-500">*</span>

                                <input type="text" id="phone_number" name="phone_number"
                                    value="{{ old('phone_number') }}"
                                    class="@error('phone_number')
                            is-invalid
                        @enderror w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                @error('phone_number')
                                    <p class="text-sm text-red-500"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="city"
                                    class="@error('phone_number')
                                text-red-500
                            @enderror leading-7 text-sm text-gray-600">City

                                </label>
                                <span class="text-gray-500">*</span>

                                <input type="text" id="city" name="city" value="{{ old('city') }}"
                                    class="@error('city')
                                is-invalid
                            @enderror w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                @error('city')
                                    <p class="text-sm text-red-500"> {{ $message }}</p>
                                @enderror
                            </div>



                            <div class="space-y-2">
                                <label for="township"
                                    class="@error('township')
                                text-red-500
                            @enderror leading-7 text-sm text-gray-600">
                                    Township
                                </label>
                                <span class="text-gray-500">*</span>

                                <input id="township" type="text" name="township" value="{{ old('township') }}"
                                    class="@error('township')
                            is-invalid
                        @enderror w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                @error('township')
                                    <p class="text-sm text-red-500"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label
                                    class="@error('address_detail')
                                text-red-500
                            @enderror leading-7 text-sm text-gray-600">Full
                                    Address</label>
                                <textarea name="address_detail" rows="4"
                                    class="@error('address_detail')
                        is-invalid
                    @enderror w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"></textarea>
                                @error('address_detail')
                                    <p class="text-sm text-red-500"> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b ">
                            <button data-modal-hide="small-modal" type="submit"
                                class="text-xs font-medium bg-pearl-bush-400 text-white py-2 px-4 rounded-full cursor-pointer focus:ring-2 focus:ring-pearl-bush-500  hover:bg-pearl-bush-500 duration-300">
                                Save information</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div>

            @if (Auth::user()->address()->count() > 0)
                <div class="grid grid-cols-2 gap-3">
                    @foreach (Auth::user()->address as $address)
                        <div class="group  border space-y-3 border-pearl-bush-400 rounded-md p-5">

                            <div class="flex justify-between">
                                <div class="space-y-1">
                                    <p class="font-heading text-sm font-semibold"> Contact Number </p>
                                    <p class="text-stone-600 inline-flex items-center gap-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5 text-pearl-bush-500 ">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                        </svg>
                                        {{ $address->phone_number }}

                                    </p>
                                </div>
                                {{-- edit address form --}}
                                <div id="medium-modal-{{ $address->id }}" tabindex="-1"
                                    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative w-full max-w-xl max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow-sm ">
                                            <!-- Modal header -->
                                            <div
                                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t  border-gray-200">
                                                <h3 class="text-xl font-heading font-medium text-stone-800 ">
                                                    Update Address
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-full text-sm size-8 ms-auto inline-flex justify-center items-center "
                                                    data-modal-hide="medium-modal-{{ $address->id }}">
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <form action="{{ route('account.updateAddress', ['id' => $address->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="p-4 md:p-5 space-y-4">

                                                    <div class="space-y-2">
                                                        <label for="phone_number"
                                                            class="@error('phone_number')
                                                            text-red-500
                                                                @enderror leading-7 text-sm text-gray-600">Phone
                                                            Number
                                                        </label>
                                                        <span class="text-gray-500">*</span>

                                                        <input type="text" id="phone_number" name="phone_number"
                                                            value="{{ old('phone_number', $address->phone_number) }}"
                                                            class="@error('phone_number')
                            is-invalid
                        @enderror w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                        @error('phone_number')
                                                            <p class="text-sm text-red-500"> {{ $message }} </p>
                                                        @enderror
                                                    </div>

                                                    <div class="space-y-2">
                                                        <label for="city"
                                                            class="@error('city')
                                text-red-500
                            @enderror leading-7 text-sm text-gray-600">City

                                                        </label>
                                                        <span class="text-gray-500">*</span>

                                                        <input type="text" id="city" name="city"
                                                            value="{{ old('city', $address->city) }}"
                                                            class="@error('city')
                                is-invalid
                            @enderror w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                        @error('city')
                                                            <p class="text-sm text-red-500"> {{ $message }}</p>
                                                        @enderror
                                                    </div>



                                                    <div class="space-y-2">
                                                        <label for="township"
                                                            class="@error('township')
                                text-red-500
                            @enderror leading-7 text-sm text-gray-600">
                                                            Township
                                                        </label>
                                                        <span class="text-gray-500">*</span>

                                                        <input id="township" type="text" name="township"
                                                            value="{{ old('township', $address->township) }}"
                                                            class="@error('township')
                            is-invalid
                        @enderror w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                        @error('township')
                                                            <p class="text-sm text-red-500"> {{ $message }} </p>
                                                        @enderror
                                                    </div>

                                                    <div class="space-y-2">
                                                        <label
                                                            class="@error('address_detail')
                                text-red-500
                            @enderror leading-7 text-sm text-gray-600">Full
                                                            Address</label>
                                                        <textarea name="address_detail" rows="4"
                                                            class="@error('address_detail')

                        is-invalid
                    @enderror w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ old('address_detail', $address->address_detail) }}
                                                        </textarea>
                                                        @error('address_detail')
                                                            <p class="text-sm text-red-500"> {{ $message }} </p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Modal footer -->
                                                <div
                                                    class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b ">
                                                    <button data-modal-hide="medium-modal-{{ $address->id }}"
                                                        type="submit"
                                                        class="text-xs font-medium bg-pearl-bush-400 text-white py-2 px-4 rounded-full cursor-pointer focus:ring-2 focus:ring-pearl-bush-500  hover:bg-pearl-bush-500 duration-300">
                                                        Save information</button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="scale-0 flex  gap-x-1 group-hover:scale-100 duration-500 transition ease-in-out">
                                    <div>
                                        <button data-modal-target="medium-modal-{{ $address->id }}"
                                            data-modal-toggle="medium-modal-{{ $address->id }}"
                                            class="border border-stone-300 p-2 group hover:bg-stone-300 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-4 text-stone-500">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>

                                        </button>
                                    </div>





                                    <form action="{{ route('account.destroyAddress', ['id' => $address->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="border border-stone-300 p-2 group hover:bg-stone-300 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-4 text-stone-500">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>

                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="space-y-1">
                                <p class="font-heading font-semibold text-sm"> Shipping Address </p>
                                <p class="text-stone-600 inline-flex items-center gap-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5 text-pearl-bush-500">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>

                                    {{ $address->address_detail }}

                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-stone-100 py-16 flex flex-col gap-3 justify-center items-center px-5 rounded-lg">

                    <p> There is no delivery address yet. </p>
                    <button data-modal-target="small-modal" data-modal-toggle="small-modal"
                        class="text-sm font-medium bg-pearl-bush-400 text-white py-2 px-4 rounded-full cursor-pointer  hover:bg-pearl-bush-500 duration-300">
                        Add New Address</button>

                </div>
            @endif
        </div>
    </div>

    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const modalElement = document.getElementById('small-modal');
                if (modalElement) {
                    const modal = new Modal(modalElement);
                    modal.show();
                }
            });
        </script>
    @endif


@endsection
@push('scripts')
@endpush
