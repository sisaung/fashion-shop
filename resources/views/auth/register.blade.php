@extends('layout.master')
@section('content')
    <section class="text-gray-600 body-font">
        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <div class="container px-5 py-24 mx-auto flex flex-wrap items-center">
                <div class="lg:w-3/5 md:w-1/2 md:pr-16 lg:pr-0 pr-0">
                    <h1 class="title-font font-medium text-3xl text-gray-900">Slow-carb next level shoindcgoitch ethical
                        authentic, poko scenester</h1>
                    <p class="leading-relaxed mt-4">Poke slow-carb mixtape knausgaard, typewriter street art gentrify hammock
                        starladder roathse. Craies vegan tousled etsy austin.</p>
                </div>
                <div class="lg:w-2/6 md:w-1/2 bg-stone-50  rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0">
                    <h2 class="text-gray-900 text-lg font-medium title-font mb-5">Register</h2>

                    <div class="relative mb-4">
                        <label for="name" class="leading-7 text-sm text-gray-600">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        @error('name')
                            <p class="text-sm text-red-500"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="relative mb-4">
                        <label for="email" class="@error('email')
                            text-red-500
                        @enderror leading-7 text-sm text-gray-600">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="w-full @error('email')
                                is-invalid
                            @enderror bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        @error('email')
                            <p class="text-sm text-red-500"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="relative mb-4">
                        <label for="password" class="@error('password')
                            text-red-500

                        @enderror leading-7 text-sm text-gray-600">Password</label>
                        <input type="password" id="password" name="password"
                            class="w-full @error('password')
                                    is-invalid
                            @enderror bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        @error('password')
                            <p class="text-sm text-red-500"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="relative mb-4">
                        <label for="password_confirmation" class="@error('password_confirmation')
                        text-red-500
                        @enderror leading-7 text-sm text-gray-600">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full @error('password_confirmation')
                                    is-invalid
                            @enderror bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        @error('password_confirmation')
                            <p class="text-sm text-red-500"> {{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit"
                        class="text-white bg-pearl-bush-400 border-0 py-2 px-8 focus:outline-none hover:bg-pearl-bush-600 rounded text-sm cursor-pointer duration-300">Register</button>
                    <p class="text-xs text-gray-500 mt-3"> Already have an account? <span> <a href="{{ route('login') }}"
                                class="text-pearl-bush-400 hover:text-pearl-bush-600 underline underline-offset-4">Login</a>
                        </span> </p>
                </div>
            </div>
        </form>
    </section>
@endsection
