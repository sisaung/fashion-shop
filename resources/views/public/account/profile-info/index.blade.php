@extends('components.public.accountLayout')
@section('container')
    <div class="px-5">
        <h1 class="mt-5 text-stone-700 font-heading mb-5"> Profile Information </h1>
        <div class="mb-5 size-24 relative rounded-full inline-flex justify-center items-center">
            <input type="file" class="hidden image-file-upload">
            @if ($user->profile_image)
                <img src="{{ $user->profile_image }}" class="w-full h-full object-cover object-center rounded-full"
                    alt="{{ $user->name }}">
                <button data-user-profile="{{ route('account.showProfileInformation') }}"
                    class="change-profile-btn cursor-pointer absolute border-2 border-white  bottom-0 right-0 bg-pearl-bush-400 size-6 rounded-full inline-flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-3.5 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                    </svg>

                </button>
            @else
                <img src="https://i0.wp.com/digitalhealthskills.com/wp-content/uploads/2022/11/3da39-no-user-image-icon-27.png?fit=500%2C500&ssl=1≈"
                    class="w-full h-full object-cover object-center rounded-full" alt="{{ $user->name }}">
                <button data-user-profile="{{ route('account.showProfileInformation') }}"
                    class="change-profile-btn cursor-pointer absolute border-2 border-white  bottom-0 right-0 bg-pearl-bush-400 size-6 rounded-full inline-flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>

                </button>
            @endif
        </div>

        <div class="flex items-center gap-x-3 border-b border-b-stone-200 pb-4 mb-8">

            <div class="size-10  inline-flex justify-center items-center rounded-full border border-pearl-bush-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-3.5 text-pearl-bush-400">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>

            </div>

            <div>
                <p class="text-stone-700 font-heading">Your Name</p>
                <p class="text-stone-500"> {{ $user->name }} </p>
            </div>

        </div>

        <div class="flex items-center gap-x-3 border-b border-b-stone-200 pb-4 mb-8">

            <div class="size-10  inline-flex justify-center items-center rounded-full border border-pearl-bush-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-3.5 text-pearl-bush-400">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                </svg>


            </div>

            <div>
                <p class="text-stone-700 font-heading">Your Email</p>
                <p class="text-stone-500"> {{ $user->email }} </p>
            </div>

        </div>

        <button data-modal-target="small-modal" data-modal-toggle="small-modal"
            class="text-xs font-medium bg-pearl-bush-400 text-white py-2 px-4 rounded-full cursor-pointer  hover:bg-pearl-bush-500 duration-300">Edit
            Profile</button>

        <div id="small-modal" tabindex="-1"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm ">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t  border-gray-200">
                        <h3 class="text-xl font-heading font-medium text-stone-800 ">
                            Edit User Profile
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
                    <form action="{{ route('account.changeName') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="p-4 md:p-5 space-y-4">
                            <label for="name"
                                class="@error('name')
                                        text-red-500
                                    @enderror leading-7 text-sm text-gray-600">Your
                                Name
                                Name</label>
                            <span class="text-gray-500">*</span>

                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                class="@error('name')
                                        is-invalid
                                    @enderror w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            @error('name')
                                <p class="text-sm text-red-500"> {{ $message }}</p>
                            @enderror
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
    </div>
@endsection
@push('scripts')
    @vite(['resources/js/profile/changeUserProfile.js'])
@endpush
