<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Neuron Production | Digital Creative Agency</title>
  <meta name="description" content="Neuron Production — jasa desain poster, banner, dan pembuatan website profesional.">
  <link rel="preconnect" href="https://unpkg.com" crossorigin>
  <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
  <link href="/src/style.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/aos.css') }}" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="shortcut icon" href="{{ asset('images/app-layout/navlogo-64.png') }}" type="image/png"/>
  @stack('head')
</head>
<style>
    body {
        background-color: #0C0C28;
        font-family: 'Poppins', sans-serif;
        
    }

  /* BUAT ANIMASI OPENING DIKIT DOANG TARO DI INLINE FILE AJA */
  .loader {
  position: fixed;
  inset: 0;
  background: radial-gradient(circle at center, #17134d 0%, #0C0C28 70%);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 14px;
  z-index: 9999;
}

.logo {
  width: 80px;
  animation: pulse 1.5s infinite;
}

.brand-text {
  font-size: 26px;
  font-weight: 600;
  letter-spacing: 2px;
  color: #fff;
  opacity: 0;
  transform: translateY(12px);
  transition: all 0.6s ease;
}

.brand-text.active {
  opacity: 1;
  transform: translateY(0);
}

@keyframes pulse {
  0% { transform: scale(1); }
  /* 50% { transform: scale(1.08); }
  100% { transform: scale(1); } */
}
</style>
<body class="">

<!-- ===== ANIMASI OPENING WEB (hanya sekali per kunjungan, tidak di refresh/pindah halaman) ===== -->
 <div 
  x-data="{
    showText: false,
    showLoader: (() => {
      try {
        if (sessionStorage.getItem('np_has_loaded') === '1') return false;
        sessionStorage.setItem('np_has_loaded', '1');
        return true;
      } catch (e) { return true; }
    })()
  }"
  x-init="
    if (showLoader) {
      setTimeout(() => showText = true, 700);
      setTimeout(() => showLoader = false, 1600);
    }
  "
  x-show="showLoader"
  x-transition.opacity.duration.600ms
  class="loader"
>
  <img src="{{ asset('images/app-layout/iconlogo.png') }}" alt="Neuron Production" class="logo">
  <span 
    class="brand-text"
    :class="{ 'active': showText }"
  >
    NEURON PRODUCTION
  </span>
</div>
<!-- === END ===== -->

<!-- ========= navbar/header ========== -->
<nav>
    <header id="header" class="w-full mx-auto px-4 md:px-[55px] py-2 md:py-4  flex items-center sticky lg:fixed justify-between w-full top-0 text-white z-50" >
        <div class="md:bg-[transparent] w-full flex items-center justify-between px-2 py-2 rounded-full">
        <div class="flex items-center space-x-2">
            <div class="">
                <img src="{{ asset('images/app-layout/iconlogo.png') }}" alt="Neuron production" class="p-1 h-[45px] md:h-[50px] md:h-[60px]">
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
    <div aria-hidden="true" class="fixed inset-0 bg-black/50 z-40 hidden" id="mobile-menu">
    </div>
    <nav aria-label="Mobile Navigation"
        class="fixed top-0 left-0 bottom-0 w-64 backdrop-blur-md z-50 transform -translate-x-full transition-transform duration-300 ease-in-out"
        id="mobile-nav">
        <div class="flex items-center justify-between px-6 py-6 border-b border-gray-200">
            <div class="text-white flex items-center space-x-2">
                <span class="font-semibold text-xl select-none">
                    Menu
            </div>
            <button aria-label="Close menu" class="text-white hover:text-black focus:outline-none"
                id="mobile-menu-close">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round">
                    </path>
                </svg>
            </button>
        </div>
        <ul class="px-6 text-white py-4 space-y-4 text-base font-normal">
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
  <div class="content px-6 md:px-16">
    @yield('content')
  </div>
  <!-- ======= end ======= -->

  <!-- ======== footer ========= -->
<footer class="bg-gradient-to-br p-4 from-[#2b1f7a] via-[#2a2f8f] to-[#1b1f5f] text-white rounded-2xl mx-4 my-10 [content-visibility:auto] [contain-intrinsic-size:auto_400px]">
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

        <div class="flex items-center gap-3 text-gray-200">
          <!-- Instagram -->
          <a href="https://www.instagram.com/neuronproduction" target="_blank" rel="noopener"
            class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-white/10 hover:bg-white/20 transition"
            aria-label="Instagram Neuron Production">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
            </svg>
          </a>
          <!-- TikTok -->
          <a href="https://www.tiktok.com/@neuronproduction" target="_blank" rel="noopener"
            class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-white/10 hover:bg-white/20 transition"
            aria-label="TikTok Neuron Production">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
              <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z" />
            </svg>
          </a>
          <span>neuronproduction</span>
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
    AOS.init({ once: true, duration: 600, offset: 60 });
  </script>
</body>

</html>
