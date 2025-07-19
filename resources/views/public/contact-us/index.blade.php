@extends('layout.master')
@section('content')
    <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12 md:py-7">

        <!-- Breadcrumbs -->

        @include('components.breadcrumb', [
            'currentPageTitle' => 'Contact Us',
        ])



        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 ">

            <div class="space-y-5 border-2 border-solid rounded-lg p-5">
                <div>
                    <h2 class="text-xl font-semibold mb-2">Chat with us</h2>
                    <p class="text-gray-500 mb-3">Contact us for support that’s made just for you.</p>
                    <a href="https://www.google.com/" class="text-blue-600 hover:underline">loomluxe@gmail.com</a>
                    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                </div>
                <div>
                    <h2 class="text-xl font-semibold mb-2">Call us</h2>
                    <p class="text-gray-500 mb-3">Need Help? Call Us Now!</p>
                    <a href="tel:+9569784517891" class="text-blue-600 hover:underline">+95 69784517891</a>
                    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                </div>
                <div>
                    <h2 class="text-xl font-semibold mb-2">Address</h2>
                    <p class="text-gray-900">No. 123, Fashion Street, Yangon, Myanmar</p>
                </div>

            </div>

            <div>
                <form action="#" method="POST" class="space-y-7 border-2 border-solid rounded-lg p-5">
                    <div>
                        <label for="name" class="sr-only">Name</label>
                        <input type="text" name="name" id="name"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black sm:text-sm p-4"
                            placeholder="Name">
                    </div>
                    <div>
                        <label for="phone" class="sr-only">Phone Number</label>
                        <input type="tel" name="phone" id="phone"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black sm:text-sm p-4"
                            placeholder="Phone Number">
                    </div>
                    <div>
                        <label for="message" class="sr-only">Message</label>
                        <textarea id="message" name="message" rows="6"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black sm:text-sm p-4"
                            placeholder="Message"></textarea>
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Map Section -->
        <div class="mt-20">

            <div id="map" class="w-full rounded-lg"></div>
        </div>
    @endsection
