@extends('layout.master')
@section('content')
    <section class="text-gray-600 body-font bg-stone-50 h-screen overflow-hidden">
        <div class="flex gap-10">
            <div class="w-1/2 relative flex justify-center items-center  h-screen">

                <img src="{{ asset('/storage/login/login.jpg') }}" class="w-full h-full object-center object-cover" alt="">
                <div class="w-full h-full absolute top-0 left-0 bg-black/10"></div>
                <div class="absolute left-10 bottom-30 py-2 space-y-2">
                    <h2 class="text-white text-4xl font-heading"> Welcome Back </h2>
                    <p class="text-white/90"> Our Fashion Shop </p>
                </div>
            </div>
            <form action="{{ route('login.post') }}" method="POST" class="w-1/3 mx-auto mt-20">
                @csrf
                <div
                    class="bg-white  shadow gap-3 rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0">
                    <div class="mb-5 space-y-1">
                        <h2 class="text-gray-900 text-2xl font-medium title-font text-center"> Login </h2>
                    </div>

                    <div class="relative mb-4">
                        <label for="email"
                            class="leading-7  @error('email')
                                text-red-500
                            @enderror text-sm text-gray-600">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="w-full @error('email')
                                is-invalid
                            @enderror bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        @error('email')
                            <p class="text-sm text-red-500"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="relative mb-4">
                        <label for="password"
                            class="@error('password')
                            text-red-500
                        @enderror leading-7 text-sm text-gray-600">Password</label>
                        <input type="password" id="password" name="password"
                            class="w-full  @error('password')
                                is-invalid
                            @enderror bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        @error('password')
                            <p class="text-sm text-red-500"> {{ $message }}</p>
                        @enderror
                    </div>
                    <button
                        class="text-white bg-pearl-bush-400 border-0 py-2 px-8 focus:outline-none hover:bg-pearl-bush-600 rounded text-sm cursor-pointer duration-300">Login</button>
                    <p class="text-xs text-center text-gray-500 mt-3"> Don't have an account? <span> <a
                                href="{{ route('register') }}"
                                class="text-pearl-bush-400 hover:text-pearl-bush-600 underline underline-offset-4">Register</a>
                        </span> </p>
                </div>
            </form>
        </div>
        {{-- <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="container px-5 py-24 mx-auto flex flex-wrap items-center">
                <div class="lg:w-1/4 md:w-1/2 md:pr-16 lg:pr-0 pr-0">

                    <img src="{{ asset('/storage/login/fashion-login.avif') }}" alt="">
                </div>

            </div>
        </form> --}}
    </section>
@endsection
