@extends('layout.dashboard')
@section('content')
    <section class="px-5 mt-5 bg-white py-5 rounded-lg shadow">

        @include('components.admin.breadcrumb', [
            'currentPageTitle' => 'Change Name',
            'links' => [['name' => 'Profile', 'path' => route('admin-profile.index')]],
        ])

        <div class="grid grid-cols-3 mt-5">
            <div class="col-span-1 px-5 border border-stone-50 shadow-md p-4 rounded">

                <form action="{{ route('admin-profile.change-name') }}" method="POST">
                    @csrf
                    <div class="relative mb-4">
                        <label for="name"
                            class="leading-7  @error('name')
                            text-red-500
                        @enderror text-sm text-gray-600">Name</label>
                        <input type="name" id="name" name="name" value="{{ old('name') }}"
                            class="w-full @error('name')
                            is-invalid
                        @enderror bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        @error('name')
                            <p class="text-sm text-red-500"> {{ $message }}</p>
                        @enderror
                    </div>
                    <button
                        class="inline-flex px-6 items-center gap-x-2 text-sm bg-pearl-bush-400 text-white py-2 rounded-md cursor-pointer  hover:bg-pearl-bush-500 duration-300">


                        Update </button>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('scripts')

@endpush
