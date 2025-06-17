@extends('layout.dashboard')
@section('content')
    <div class="py-5">
        @include('components.admin.breadcrumb', [
            'currentPageTitle' => 'Profile',
        ])
    </div>
    <section class="px-5">
        <div class="grid grid-cols-3">
            <div class="col-span-1 px-5 border border-stone-50 shadow-md p-4 rounded">
                <h1 class="text-xl font-heading mb-5 px-2"> Profile Settings </h1>
                <div class="relative inline-block">
                    @if (Auth::user()->profile_image)
                        <img src="{{ Auth::user()->profile_image }}" alt="avatar"
                            class="size-18 object-cover object-center rounded-full">
                        <button data-admin-profile="{{ route('admin-profile.index') }}"
                            class="change-profile-btn cursor-pointer absolute border-2 border-white  bottom-0 right-0 bg-pearl-bush-400 size-6 rounded-full inline-flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-3.5 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>

                        </button>
                    @else
                        <img src="https://i0.wp.com/digitalhealthskills.com/wp-content/uploads/2022/11/3da39-no-user-image-icon-27.png?fit=500%2C500&ssl=1"
                            class="size-18 object-cover object-center rounded-full" alt="fallback">
                        <button data-admin-profile="{{ route('admin-profile.index') }}"
                            class="change-profile-btn cursor-pointer absolute border-2 border-white  bottom-0 right-0 bg-pearl-bush-400 size-6 rounded-full inline-flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-3.5 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>


                        </button>
                    @endif

                    <input type="file" class="hidden image-file-upload" name="profile_image" accept="image/png, image/jpg, image/jpeg, image/gif">
                </div>

                <div class="space-y-4 mt-5 pb-5">
                    <div class="flex items-center gap-x-2">
                        <p class=""> {{ Auth::user()->name }} </p>
                        <a href="{{ route('admin-profile.change-name-index') }}"
                            class="cursor-pointer bg-pearl-bush-400 rounded-full inline-flex justify-center items-center size-5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-3 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg></a>
                    </div>
                    <a href="{{ route('admin-profile.change-password-index') }}"
                        class="cursor-pointer gap-x-2  bg-pearl-bush-400 text-white px-4 py-2 text-sm rounded-md hover:bg-pearl-bush-500 duration-300 inline-flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                        </svg>
                        Change Password </a>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    @vite(['resources/js/changeAdminProfile.js'])
@endpush
