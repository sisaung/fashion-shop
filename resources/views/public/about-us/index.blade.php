@extends('layout.master')
@section('content')
    <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12 md:py-7">

        <!-- Breadcrumbs -->

        @include('components.breadcrumb', [
            'currentPageTitle' => 'About Us',
        ])


        {{-- <div class="max-w-3xl mx-auto px-4 py-12">

            <!-- Heading -->
            <h2 class="text-2xl font-bold mb-4">About Us</h2>

            <!-- Who We Are -->
            <p class="mb-6 text-gray-700">
                We are a passionate team bringing you trendy and quality fashion at the best prices. Our shop is dedicated
                to making you look stylish every day.
            </p>

            <!-- Our Mission -->
            <h3 class="text-xl font-semibold mb-2">Our Mission</h3>
            <p class="mb-6 text-gray-700">
                Our mission is to make fashion affordable and accessible to everyone, helping you express your style with
                confidence.
            </p>

            <!-- Our Story -->
            <h3 class="text-xl font-semibold mb-2">Our Story</h3>
            <p class="mb-6 text-gray-700">
                Founded in 2023, we started with the idea of making stylish clothing easy to shop online. Today, we serve
                thousands of happy customers with love and care.
            </p>

            <!-- What Makes Us Different -->
            <h3 class="text-xl font-semibold mb-2">What Makes Us Different</h3>
            <p class="mb-6 text-gray-700">
                We focus on premium quality products, fast delivery, and excellent customer support to make your shopping
                experience smooth and happy.
            </p>

            <!-- Our Values -->
            <h3 class="text-xl font-semibold mb-2">Our Values</h3>
            <p class="mb-6 text-gray-700">
                Quality, Trust, and Customer Happiness are at the heart of everything we do.
            </p>

            <!-- Achievements / Social Proof -->
            <h3 class="text-xl font-semibold mb-2">Our Achievements</h3>
            <p class="mb-6 text-gray-700">
                Trusted by over 5000+ happy customers across the country.
            </p>

            <!-- Call to Action -->
            <div class="mt-8">
                <p class="text-lg font-medium mb-4">Explore our collections and find your perfect style today!</p>
                <a href="/shop" class="inline-block bg-black text-white px-4 py-2 rounded hover:bg-gray-800">Shop Now</a>
            </div>

            <!-- Social Media Links -->
            <div class="mt-10">
                <p class="font-medium mb-2">Follow us on:</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-600 hover:text-black">Instagram</a>
                    <a href="#" class="text-gray-600 hover:text-black">Facebook</a>
                </div>
            </div>

        </div> --}}

        {{-- Story Section --}}
        <section class="py-20">
            <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                {{-- Text Content --}}
                <div>
                    <h2 class="text-4xl md:text-5xl font-serif text-gray-900 mb-6">
                        Our Story
                    </h2>
                    <div class="space-y-5 text-gray-700 text-lg leading-relaxed">
                        <p>
                            Founded with a passion for fashion, Élegance started as a small online shop with a big dream – to bring stylish, high-quality pieces to everyone.
                        </p>

                        <p>
                            Every piece in our collection is carefully chosen and crafted to make you feel elegant and special, no matter the occasion.
                        </p>
                    </div>
                </div>

                {{-- Image Content --}}
                <div class="relative">
                    <img src="https://images.pexels.com/photos/5864245/pexels-photo-5864245.jpeg?auto=compress&cs=tinysrgb&w=800&h=1000&fit=crop"
                        alt="Fashion atelier" class="w-full h-[600px] object-cover rounded-lg shadow-lg" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-lg"></div>
                </div>

            </div>
        </section>

        {{-- Values Section --}}
        <section class="py-20 ">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <h2 class="text-4xl md:text-5xl font-serif text-gray-900 mb-4">Our Values</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-12">
                    The principles that guide every creation and define our commitment to excellence
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    {{-- Craftsmanship --}}
                    <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
                        <h3 class="text-2xl font-serif text-gray-900 mb-3">Craftsmanship</h3>
                        <p class="text-gray-600">
                            Every piece is meticulously handcrafted by master artisans with decades of experience.
                        </p>
                    </div>

                    {{-- Sustainability --}}
                    <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
                        <h3 class="text-2xl font-serif text-gray-900 mb-3">Sustainability</h3>
                        <p class="text-gray-600">
                            We are committed to ethical practices and sustainable materials to protect our earth.
                        </p>
                    </div>

                    {{-- Innovation --}}
                    <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
                        <h3 class="text-2xl font-serif text-gray-900 mb-3">Innovation</h3>
                        <p class="text-gray-600">
                            While honoring tradition, we embrace new technologies to create the fashion of tomorrow.
                        </p>
                    </div>
                </div>

            </div>
        </section>
    @endsection
