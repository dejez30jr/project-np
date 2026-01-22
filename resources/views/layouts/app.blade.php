<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="shortcut icon" href="{{ asset('images/app-layout/navlogo.png') }}" type="image/x-icon"/>
</head>
<style>
    body {
        background-color: #0C0C28;
        font-family: 'Poppins', sans-serif;
        
    }
</style>
<body class="">
<!-- ========= navbar/header ========== -->
<nav>
    <header id="header" class="w-full mx-auto px-4 md:px-20 py-4 md:py-8 flex items-center sticky lg:fixed justify-between w-full top-0 text-white z-50" >
        <div class="md:bg-[transparent] w-full flex items-center justify-between px-2 py-2 rounded-full">
        <div class="flex items-center space-x-2">
            <div class="">
                <img src="{{ asset('images/app-layout/iconlogo.png') }}" alt="Neuron production" class="h-[50px] md:h-[60px]">
            </div>
        </div>
        <!-- Hamburger button for mobile -->
        <button aria-expanded="false" aria-label="Toggle menu" class="md:hidden relative w-8 h-8 focus:outline-none"
            id="menu-btn">
            <span class="block absolute h-0.5 w-6 bg-white rounded left-1 top-2 transition-transform duration-300">
            </span>
            <span class="block absolute h-0.5 w-4 bg-white rounded right-1 top-4.5 transition-opacity duration-300">
            </span>
            <span class="block absolute h-0.5 w-6 bg-white rounded left-1 top-6 transition-transform duration-300">
            </span>
        </button>
        <nav class="hidden md:flex gap-10 text-black items-center p-2 px-6 rounded-[20px] text-lg font-normal" id="menu">
            <div class="bg-gradient-to-r from-[#363089] to-[#1C1762] flex text-black items-center bg-lime-400 p-2 px-4 rounded-[20px] text-lg font-normal">
            <a class="hover:underline whitespace-nowrap text-white px-3" href="/#hero">
                Home
            </a>
            <a class="hover:underline whitespace-nowrap text-white px-3" href="/#pricing">
                Our Services
            </a>
            <a class="hover:underline whitespace-nowrap text-white px-3" href="/#projects">
              Our Works
            </a>
            </div>

             <a href="/#contact" class="bg-gradient-to-r from-[#363089] to-[#1C1762] text-white py-2 px-4 rounded-3xl">Contact</a>
        </nav>
        </div>
    </header>
    <!-- Mobile menu -->
    <div aria-hidden="true" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden" id="mobile-menu">
    </div>
    <nav aria-label="Mobile Navigation"
        class="fixed top-0 left-0 bottom-0 w-64 bg-white z-50 transform -translate-x-full transition-transform duration-300 ease-in-out"
        id="mobile-nav">
        <div class="flex items-center justify-between px-6 py-6 border-b border-gray-200">
            <div class="flex items-center space-x-2">
                <span class="font-semibold text-xl select-none">
                    Menu
            </div>
            <button aria-label="Close menu" class="text-gray-700 hover:text-black focus:outline-none"
                id="mobile-menu-close">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round">
                    </path>
                </svg>
            </button>
        </div>
        <ul class="px-6 py-4 space-y-4 text-base font-normal">
            <li>
                <a class="block hover:underline" href="/#">
                    Home
                </a>
            </li>
            <li>
                <a class="block hover:underline" href="/#pricing">
                    Our Services
                </a>
            </li>
            <li>
                <a class="block hover:underline" href="/#projects">
                 Our Works
                </a>
            </li>
            <li>
                <a class="block hover:underline" href="/#contact">
                    Contact
                </a>
        </ul>
    </nav>
  <!-- ======== navbar/header endddd ========== -->

  <!-- ====== tempat untuk isi content ======= -->
  <div class="content px-4 md:px-16">
    @yield('content')
  </div>
  <!-- ======= end ======= -->

  <!-- ======== footer ========= -->
<footer class="bg-gradient-to-br p-4 from-[#2b1f7a] via-[#2a2f8f] to-[#1b1f5f] text-white rounded-2xl mx-4 my-10">
  <div class="w-full px-6 rounded-lg py-14 border">
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

      <!-- Brand -->
      <div>
        <div class="flex items-center gap-2 mb-4">
          <img src="{{ asset('images/app-layout/iconlogo.png') }}" alt="">
        </div>

        <p class="text-gray-200 max-w-sm mb-6">
          Turning ideas into impactful digital experiences. Let’s build something great together.
        </p>

        <div class="flex items-center gap-2 text-gray-200">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M16 8a6 6 0 01-12 0 6 6 0 0112 0zM12 14v7m-4-3h8" />
          </svg>
          <span>@neuronproduction_</span>
        </div>
      </div>

      <!-- Extra Links -->
      <div class="md:text-end">
        <h4 class="font-semibold text-lg mb-4">Extra links</h4>
        <ul class="space-y-3 text-gray-200">
          <li><a href="#" class="hover:text-white transition">Home</a></li>
          <li><a href="#" class="hover:text-white transition">Our Service</a></li>
          <li><a href="#" class="hover:text-white transition">Our Works</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div class="md:text-end">
        <h4 class="font-semibold text-lg mb-4">Contact</h4>
        <ul class="space-y-3 text-gray-200">
          <li>Neuronproduction@gmail.com</li>
          <li>(+62) 851-5806-6142</li>
        </ul>
      </div>

    </div>

    <!-- Bottom -->
    <div class="border-t border-white/20 mt-12 pt-6 text-sm text-center text-gray-300">
      © 2026 Neuron Production. All rights reserved.
    </div>

  </div>
</footer>
  <!-- ===== foooter enddd ======= -->
   
  <script src="{{ asset('layouts-js/app.js') }}"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>