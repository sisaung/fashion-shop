@extends('layout.dashboard')
@section('content')
    <section class="px-5">

        @include('components.admin.breadcrumb', [
            'currentPageTitle' => 'Change Password',
            'links' => [['name' => 'Profile', 'path' => route('admin-profile.index')]],
        ])

        <div class="grid grid-cols-3">
            <div class="col-span-1 px-5 border border-stone-50 shadow-md p-4 rounded">

                <form action="{{ route('admin-profile.change-password') }}" method="POST">
                    @csrf
                    <div class="relative mb-4">
                        <label for="old_password"
                            class="leading-7  @error('old_password')
                            text-red-500
                        @enderror text-sm text-gray-600">Old
                            Password</label>
                        <input type="password" id="old_password" name="old_password" value="{{ old('old_password') }}"
                            class="w-full @error('old_password')
                            is-invalid
                        @enderror bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        @error('old_password')
                            <p class="text-sm text-red-500"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="relative mb-4">
                        <label for="password"
                            class="leading-7  @error('password')
                            text-red-500
                        @enderror text-sm text-gray-600">New
                            Password</label>
                        <input type="password" id="password" name="password" value="{{ old('password') }}"
                            class="w-full @error('password')
                            is-invalid
                        @enderror bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        @error('password')
                            <p class="text-sm text-red-500"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="relative mb-4">
                        <label for="password_confirmation"
                            class="leading-7  @error('password_confirmation')
                            text-red-500
                        @enderror text-sm text-gray-600">New
                            Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            value="{{ old('password_confirmation') }}"
                            class="w-full @error('password_confirmation')
                            is-invalid
                        @enderror bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        @error('password_confirmation')
                            <p class="text-sm text-red-500"> {{ $message }}</p>
                        @enderror
                    </div>
                    <button
                        class="inline-flex px-6 items-center gap-x-2 text-sm bg-pearl-bush-400 text-white py-2 rounded-md cursor-pointer  hover:bg-pearl-bush-500 duration-300">

                        Change </button>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    @vite(['resources/js/changeAdminProfile.js'])
@endpush
