<!-- inline css -->
<style>
    #hero-image {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    .gradient-purple-text {
        background: linear-gradient(135deg, #c084fc 0%, #a855f7 50%, #9333ea 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .glow-dot {
        box-shadow: 0 0 10px #a855f7, 0 0 18px #9333ea;
    }

    .service-card {
        background: linear-gradient(180deg, rgba(16, 20, 36, 0.7) 0%, rgba(9, 12, 23, 0.85) 100%);
        border: 1px solid rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(12px);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .service-card:hover {
        border-color: rgba(168, 85, 247, 0.35);
        box-shadow: 0 10px 30px -10px rgba(147, 51, 234, 0.15);
        transform: translateY(-2px);
    }

    .pill-tag {
        background: rgba(147, 51, 234, 0.1);
        border: 1px solid rgba(168, 85, 247, 0.22);
        transition: all 0.2s ease;
    }

    .pill-tag:hover {
        background: rgba(147, 51, 234, 0.2);
        border-color: rgba(168, 85, 247, 0.45);
    }
</style>

<body class="overflow-x-hidden">
    @extends('layouts.app')
    @push('head')
        <link rel="preload" as="image" href="{{ asset('images/page/iconhero.webp') }}" fetchpriority="high" />
    @endpush
    @section('content')
        <!-- ======= Hero Section ========= -->
        <section
            class="text-whiterelative overflow-hidden lg:min-h-screen lg:pt-10 flex flex-wrap-reverse md:flex-row justify-center md:items-center md:py-[15%] lg:py-0 gap-8">
            <!-- Content -->
            <div class="flex-1 z-10">
                <h1 class="text-4xl md:text-6xl font-bold text-white leading-snug">
                    Transforming ideas into impactful
                    <span class="">digital experiences.</span>
                </h1>

                <p class="text-white mt-4 md:mt-8 text-base md:text-lg leading-relaxed">
                    Neuron Production is a digital agency focused on crafting
                    seamless websites, intuitive user experiences, and impactful
                    visual designs.
                </p>

                <div class="flex flex-wrap gap-4 mt-8">
                    <a href="#form-kontak"
                        class="bg-purple-700 text-white px-6 py-3 rounded-tr-[20px] rounded-bl-[20px] shadow hover:bg-purple-800 transition">
                        Let’s Build Your Website
                    </a>
                    <a href="#projects"
                        class="border border-purple-700 text-purple-700 px-6 py-3 rounded-tr-[20px] rounded-bl-[20px] hover:bg-purple-700 hover:text-white transition">
                        View Our Works
                    </a>
                </div>
            </div>

            <!-- img yaa ni -->
            <div class="flex mt-8 justify-center lg:static md:absolute md:top-[100px] md:right-[50px] md:justify-end items-center md:z-5 lg:z-10"
                id="hero-image">
                <img src="{{ asset('images/page/iconhero.webp') }}" alt="Hero Image" width="524" height="733"
                fetchpriority="high" decoding="async"
                class="w-1/2 md:w-[300px] lg:w-[400px] opacity-80 aspect-[524/733]" />
            </div>
        </section>

        <!-- ====== section services (mengambil alih konten why choose us) ====== -->
        <section aria-labelledby="why-choose-us-heading" id="services" class="mt-20 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 lg:gap-16 items-start">
                <!-- Left Column: Title, Narrative & Statistics -->
                <div class="md:sticky md:top-36 lg:col-span-6 flex flex-col items-start pr-0 lg:pr-6">
                    <!-- Main Bold Headline -->
                    <h1
                        class="text-3xl md:text-5xl font-bold text-white leading-tight mb-6" id="why-choose-us-heading">
                        Why Choose Us?
                    </h1>
                    <!-- Descriptive Subtitle -->
                    <p class="text-slate-400 text-sm sm:text-base leading-relaxed max-w-lg mb-6 md:mb-12">
                        Combining strategic design, high-speed engineering, and tailored visual narratives that empower
                        brand growth without cookie-cutter limitations.
                    </p>
                    <!-- Divider line -->
                    <div class="w-full border-t border-slate-800/80 md:flex hidden mb-4 md:mb-10"></div>
                </div>
                <!-- Right Column: Numbered Value Propositions -->
                <div class="lg:col-span-6 sticky top-50 flex flex-col divide-y bg-gradient-to-r from-[#2E287E] to-[#181642] rounded-2xl border border-white">
                    <!-- Item 01 -->
                    <article class="sticky top-16 md:top-36 p-6 bg-gradient-to-r from-[#2E287E] to-[#181642] border-t-2 border-white pb-8 first:rounded-t-2xl pt-8 group transition duration-200">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex items-baseline gap-2.5">
                                <h3 class="text-lg font-bold text-white tracking-tight group-hover:text-purple-300 transition-colors">
                                    Creative &amp; Tailored UI/UX
                                </h3>
                            </div>
                            <div
                                class="shrink-0 w-9 h-9 rounded-full bg-purple-950/60 border border-purple-700/30 flex items-center justify-center text-purple-300 group-hover:border-purple-500/50 transition">
                                <!-- Sparkle / Grid Glyph Icon -->
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" viewbox="0 0 24 24">
                                    <path d="M12 3v3m0 12v3M3 12h3m12 0h3M5.6 5.6l2.1 2.1m8.6 8.6l2.1 2.1M5.6 18.4l2.1-2.1m8.6-8.6l2.1-2.1"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-400 leading-relaxed mt-2.5 max-w-xl">
                            Distinctive, human-centric interfaces specifically crafted around your brand's DNA and target
                            audience. No rigid stock templates.
                        </p>
                        <div class="flex items-center gap-2 mt-3.5 text-xs text-slate-300 font-medium">
                            <span class="w-1.5 h-1.5 bg-purple-500 rounded-none inline-block"></span>
                            <span>Pixel Perfection Guarantee</span>
                        </div>
                    </article>
                    <!-- Item 02 -->
                    <article class="sticky top-16 md:top-36 p-6 bg-gradient-to-r from-[#2E287E] to-[#181642] border-t-2 border-white pb-8 first:pt-0 pt-8 group transition duration-200">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex items-baseline gap-2.5">
                                <h3 class="text-lg font-bold text-white tracking-tight group-hover:text-purple-300 transition-colors">
                                    High Performance Engineering
                                </h3>
                            </div>
                            <div
                                class="shrink-0 w-9 h-9 rounded-full bg-purple-950/60 border border-purple-700/30 flex items-center justify-center text-purple-300 group-hover:border-purple-500/50 transition">
                                <!-- Lightning / Zap Icon -->
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" viewbox="0 0 24 24">
                                    <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                                </svg>
                            </div>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-400 leading-relaxed mt-2.5 max-w-xl">
                            Lightning-fast load speeds, SEO-optimized structure, and pristine code built natively for
                            mobile responsiveness and fluid interactions.
                        </p>
                        <div class="flex items-center gap-2 mt-3.5 text-xs text-slate-300 font-medium">
                            <span class="w-1.5 h-1.5 bg-purple-500 rounded-none inline-block"></span>
                            <span>Core Web Vitals Ready</span>
                        </div>
                    </article>
                    <!-- Item 03 -->
                    <article class="sticky top-16 md:top-36 p-6 bg-gradient-to-r from-[#2E287E] to-[#181642] border-t-2 border-white pb-8 first:pt-0 pt-8 group transition duration-200">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex items-baseline gap-2.5">
                                <h3 class="text-lg font-bold text-white tracking-tight group-hover:text-purple-300 transition-colors">
                                    End-to-End Product Delivery
                                </h3>
                            </div>
                            <div
                                class="shrink-0 w-9 h-9 rounded-full bg-purple-950/60 border border-purple-700/30 flex items-center justify-center text-purple-300 group-hover:border-purple-500/50 transition">
                                <!-- Stack / Layers Icon -->
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" viewbox="0 0 24 24">
                                    <path d="m12 2 10 5-10 5L2 7l10-5Z"></path>
                                    <path d="m2 17 10 5 10-5"></path>
                                    <path d="m2 12 10 5 10-5"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-400 leading-relaxed mt-2.5 max-w-xl">
                            Comprehensive solutions spanning strategic research, wireframing, custom development, strict
                            QA testing, and frictionless deployment.
                        </p>
                        <div class="flex items-center gap-2 mt-3.5 text-xs text-slate-300 font-medium">
                            <span class="w-1.5 h-1.5 bg-purple-500 rounded-none inline-block"></span>
                            <span>Full Lifecycle Support</span>
                        </div>
                    </article>
                    <!-- Item 04 -->
                    <article class="sticky top-16 md:top-36 p-6 bg-gradient-to-r from-[#2E287E] to-[#181642] border-t-2 border-white pb-8 rounded-b-2xl pt-8 group transition duration-200">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex items-baseline gap-2.5">
                                <h3 class="text-lg font-bold text-white tracking-tight group-hover:text-purple-300 transition-colors">
                                    Business &amp; ROI Driven
                                </h3>
                            </div>
                            <div
                                class="shrink-0 w-9 h-9 rounded-full bg-purple-950/60 border border-purple-700/30 flex items-center justify-center text-purple-300 group-hover:border-purple-500/50 transition">
                                <!-- Growth Chart / Analytics Icon -->
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" viewbox="0 0 24 24">
                                    <path d="M3 3v18h18"></path>
                                    <path d="m19 9-5 5-4-4-3 3"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-400 leading-relaxed mt-2.5 max-w-xl">
                            Strategic user funnels designed to maximize conversion rates, inbound client trust, and
                            tangible revenue growth across touchpoints.
                        </p>
                        <div class="flex items-center gap-2 mt-3.5 text-xs text-slate-300 font-medium">
                            <span class="w-1.5 h-1.5 bg-purple-500 rounded-none inline-block"></span>
                            <span>Conversion Focused Architecture</span>
                        </div>
                    </article>
                </div>
            </div>
        </section>
        <!-- ==== end services ==== -->

        <!-- ==== section our pricing ===== -->
        <section class="relative mt-12 md:mt-32 [content-visibility:auto] [contain-intrinsic-size:auto_900px]" id="pricing" data-aos="zoom-in">
            <h1 class="text-3xl md:text-5xl text-white font-bold text-center">
                Simple Pricing for Every Business
            </h1>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 py-10">
                <!-- card -->
                <div class="bg-gradient-to-r from-[#2E287E] to-[#181642] p-2 rounded-[30px] flex gap-4 items-center">
                    <div class="border-2 border-white rounded-[30px] p-4 flex flex-col gap-10 w-full h-full">
                        <div class="flex text-white flex-col">
                            <span class="mb-2">UMKM Package</span>
                            <span class="text-3xl font-bold">Rp400,000</span>
                        </div>

                        <ul class="text-sm text-white mt-2 list-disc pl-5 space-y-1">
                            <li>Page landing website</li>
                            <li>Responsive design (mobile & desktop)</li>
                            <li>WhatsApp / Contact integration</li>
                            <li>Basic SEO setup</li>
                            <li>1 revision</li>
                        </ul>

                        <div class="text-white">
                            <h3 class="">Best for:</h3>
                            <p>
                                Small businesses that need a fast and simple
                                online presence.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bg-gradient-to-r from-[#2E287E] to-[#181642] p-2 rounded-[30px] flex gap-4 items-center">
                    <div class="border-2 border-white rounded-[30px] p-4 flex flex-col gap-10 w-full h-full">
                        <div class="flex text-white flex-col">
                            <span class="mb-2">Standard Package</span>
                            <span class="text-3xl font-bold">Rp500,000-Rp1,500,000</span>
                        </div>

                        <ul class="text-sm text-white mt-2 list-disc pl-5 space-y-1">
                            <li>Up to 5 website pagesr</li>
                            <li>Modern and professional UI design</li>
                            <li>Fully Responsive layout</li>
                            <li>Basic SEO optimization</li>
                            <li>Contact form & social media integration</li>
                            <li>2 revision</li>
                        </ul>

                        <div class="text-white">
                            <h3 class="">Best for:</h3>
                            <p>
                                Personal brands and small businesses looking to
                                build a professional website..
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bg-gradient-to-r from-[#2E287E] to-[#181642] p-2 rounded-[30px] flex gap-4 items-center">
                    <div class="border-2 border-white rounded-[30px] p-4 flex flex-col gap-10 w-full h-full">
                        <div class="flex text-white flex-col">
                            <span class="mb-2">Professional Package</span>
                            <span class="text-3xl font-bold">Rp1,500,000-7,700,000</span>
                        </div>

                        <ul class="text-sm text-white mt-2 list-disc pl-5 space-y-1">
                            <li>Custom multi-page websiter</li>
                            <li>Premiumm UI/UX design</li>
                            <li>Admin dashboard (CMS)</li>
                            <li>On-page SEO optimization</li>
                            <li>Basic security setup</li>
                            <li>Analytics integration</li>
                            <li>Up to 3 revisions</li>
                        </ul>

                        <div class="text-white">
                            <h3 class="">Best for:</h3>
                            <p>
                                Growing brands and businesses that need a
                                scalable, high-performance website..
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ==== secttion service endd === -->

        <!-- ==== section service project ==== -->
        <section class="py-8 md:py-16 [content-visibility:auto] [contain-intrinsic-size:auto_1200px]" id="projects" data-aos="zoom-in">
            <!-- Heading -->
            <div class="mb-14 text-white flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-400 mb-2">Our Works</p>
                    <h2 class="text-3xl md:text-5xl font-bold leading-tight">
                        Our recent work and <br class="hidden sm:block" />
                        selected projects.
                    </h2>
                </div>
                <div>
                    <img src="{{ asset('images/page/icon-project1.webp') }}" alt="" width="279" height="272" decoding="async" />
                </div>
            </div>

            {{-- box grid (layout asli, gambar dinamis: website 1, poster 2, banner 1) --}}
            @php
                $websiteCard = $ports->firstWhere('category', 'website');
                $posterCards = $ports->where('category', 'poster')->take(2)->values();
                $bannerCard = $ports->firstWhere('category', 'banner');
            @endphp

            <div class="flex md:gap-6 gap-8 flex-wrap md:flex-col lg:flex-row">
                <!-- Grid -->
                <div class="flex-1 gap-8">
                    <div class="flex md:gap-6 gap-8 mb-8">
                        <!-- Card website (lebar) -->
                        @if (isset($posterCards[1]))
                            <a href="{{ route('portfolio.show', $posterCards[1]) }}"
                                class="relative flex-1 rounded-2xl overflow-hidden bg-white/5 backdrop-blur hover:scale-[1.02] transition group">
                                <img src="{{ asset('storage/' . $posterCards[1]->img) }}" alt="{{ $posterCards[1]->title }}"
                                    class="h-full w-full object-cover" loading="lazy" />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent opacity-0 group-hover:opacity-100 transition flex flex-col justify-end p-5">
                                    <span
                                        class="inline-block w-fit text-xs font-semibold rounded-full px-3 py-1 mb-2 bg-purple-600/90 text-white">Poster/flayer</span>
                                    <h3 class="text-white font-semibold">{{ $websiteCard->title }}</h3>
                                </div>
                            </a>
                        @else
                            <div
                                class="flex-1 rounded-2xl overflow-hidden bg-white/5 backdrop-blur flex items-center justify-center min-h-[220px]">
                                <span class="text-white/40 text-sm">Belum ada proyek Website</span>
                            </div>
                        @endif

                        <!-- Card poster/flyer 1 (kecil) -->
                        @if (isset($posterCards[0]))
                            <a href="{{ route('portfolio.show', $posterCards[0]) }}"
                                class="relative md:w-[100px] flex-1 rounded-2xl overflow-hidden bg-white/5 backdrop-blur hover:scale-[1.02] transition group">
                                <img src="{{ asset('storage/' . $posterCards[0]->img) }}"
                                    alt="{{ $posterCards[0]->title }}" class="h-full w-full object-cover"
                                    loading="lazy" />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent opacity-0 group-hover:opacity-100 transition flex flex-col justify-end p-4">
                                    <span
                                        class="inline-block w-fit text-xs font-semibold rounded-full px-3 py-1 mb-2 bg-purple-600/90 text-white">Poster/Flyer</span>
                                    <h3 class="text-white font-semibold text-sm">{{ $posterCards[0]->title }}</h3>
                                </div>
                            </a>
                        @else
                            <div
                                class="md:w-[100px] flex-1 rounded-2xl overflow-hidden bg-white/5 backdrop-blur flex items-center justify-center min-h-[220px]">
                                <span class="text-white/40 text-sm">Poster/Flyer</span>
                            </div>
                        @endif
                    </div>

                    <div class="flex md:gap-6 gap-8">
                        <!-- card decor -->
                        <div
                            class="lg:flex hidden rounded-2xl overflow-hidden items-center backdrop-blur hover:scale-[1.02] transition">
                            <img src="{{ asset('images/page/icon-project2.webp') }}" alt=""
                                class="w-full h-[200px] object-cover" />
                        </div>

                        <!-- Card banner -->
                        @if ($bannerCard)
                            <a href="{{ route('portfolio.show', $bannerCard) }}"
                                class="relative flex-1 rounded-2xl overflow-hidden bg-white/5 backdrop-blur hover:scale-[1.02] transition group">
                                <img src="{{ asset('storage/' . $bannerCard->img) }}" alt="{{ $bannerCard->title }}"
                                    class="w-full h-52 object-cover" loading="lazy" />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent opacity-0 group-hover:opacity-100 transition flex flex-col justify-end p-5">
                                    <span
                                        class="inline-block w-fit text-xs font-semibold rounded-full px-3 py-1 mb-2 bg-purple-600/90 text-white">Banner</span>
                                    <h3 class="text-white font-semibold">{{ $bannerCard->title }}</h3>
                                </div>
                            </a>
                        @else
                            <div
                                class="flex-1 rounded-2xl overflow-hidden bg-white/5 backdrop-blur flex items-center justify-center min-h-[180px]">
                                <span class="text-white/40 text-sm">Belum ada proyek Banner</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Card poster/flyer 2 (tinggi di desktop) -->
                @if ($websiteCard)
                    <a href="{{ route('portfolio.show', $websiteCard) }}"
                        class="relative w-[100%] lg:w-[400px] rounded-2xl overflow-hidden bg-white/5 backdrop-blur hover:scale-[1.02] transition group">
                        <img src="{{ asset('storage/' . $websiteCard->img) }}" alt="{{ $websiteCard->title }}"
                            class="h-full w-full object-cover bg-center" loading="lazy" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent opacity-0 group-hover:opacity-100 transition flex flex-col justify-end p-5">
                            <span
                                class="inline-block w-fit text-xs font-semibold rounded-full px-3 py-1 mb-2 bg-purple-600/90 text-white">website</span>
                            <h3 class="text-white font-semibold">{{ $websiteCard->title }}</h3>
                        </div>
                    </a>
                @else
                    <div
                        class="w-[100%] lg:w-[400px] rounded-2xl overflow-hidden bg-white/5 backdrop-blur flex items-center justify-center min-h-[250px]">
                        <span class="text-white/40 text-sm">Belum ada proyek Poster/Flyer</span>
                    </div>
                @endif
            </div>
        </section>
        <!-- ==== section project end ==== -->

        <!-- ==== section contact ===== -->

        <section class="grid md:grid-cols-2 py-8 md:py-20 gap-10 [content-visibility:auto] [contain-intrinsic-size:auto_1000px]" id="contact" data-aos="zoom-in">
            <div class="text-white flex flex-col gap-4 md:gap-8">
                <h1>Contact Us</h1>
                <h2 class="md:text-5xl text-3xl font-bold mb-0 md:mb-15">Let’s discuss your project and bring your ideas to
                    life</h2>
                <button type="submit" form="form-kontak"
                    class="w-[fit-content] hidden md:flex rounded-tr-3xl rounded-bl-3xl text-end p-2 px-16 bg-gradient-to-r from-[#363089] to-[#1C1762] hover:brightness-110 transition cursor-pointer">
                    Send Message
                </button>
            </div>

            {{-- BAGIAN KANAN (Form) --}}
            <div>
                {{-- Pesan Error Validasi --}}
                @if ($errors->any())
                    <div
                        style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 20px; border-radius: 5px;">
                        <ul style="list-style: disc; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- aler Sukses --}}
                @if(session('success'))
                   <script>
                     document.addEventListener('DOMContentLoaded', () => {
                       Swal.fire({
                         title: "Pesan berhasil dikirim!",
                         icon: "success",
                         draggable: true
                       });
                     });
                   </script>
                @endif

                {{-- Alert Gagal / Rate Limit --}}
                @if(session('error'))
                   <script>
                     document.addEventListener('DOMContentLoaded', () => {
                       Swal.fire({
                         title: "Pengiriman dibatasi!",
                         text: @json(session('error')),
                         icon: "warning",
                         draggable: true
                       });
                     });
                   </script>
                @endif

                {{-- FORM UTAMA --}}
                <form id="form-kontak" action="{{ route('contact.send') }}" method="POST"
                    class="flex flex-col gap-4 p-2 rounded-lg bg-gradient-to-r from-[#363089] to-[#1C1762]">
                    <div class="flex flex-col gap-4 border border-white p-4 rounded-lg">
                    @csrf

                    {{-- Honeypot: field tersembunyi anti-bot --}}
                    <div class="hidden" aria-hidden="true">
                        <input type="text" name="website" value="" tabindex="-1" autocomplete="off" />
                    </div>

                    <label class="text-white">Name</label>
                    <input class="bg-transparent border rounded-lg p-4 text-white placeholder-gray-300" type="text"
                        name="name" required maxlength="100" placeholder="Your Name" value="{{ old('name') }}" />

                    <label class="text-white">Email</label>
                    <input class="bg-transparent border rounded-lg p-4 text-white placeholder-gray-300" type="email"
                        name="email" required maxlength="150" placeholder="Your Email" value="{{ old('email') }}" />

                    <label class="text-white">Message</label>
                    <textarea class="bg-transparent border text-white p-4 placeholder-gray-300" name="message" required
                        maxlength="2000" cols="15" rows="10">{{ old('message') }}</textarea>

                    {{-- CAPTCHA (pertanyaan matematika) --}}
                    <label class="text-white">
                        Verifikasi: <span class="font-bold tracking-wider">{{ $captchaQuestion }}</span>
                    </label>
                    <input class="bg-transparent border rounded-lg p-4 text-white placeholder-gray-300" type="text"
                        name="captcha" required inputmode="numeric" autocomplete="off" maxlength="6"
                        placeholder="Masukkan jawaban" />
                    <input type="hidden" name="captcha_token" value="{{ $captchaToken }}" />

                    <button type="submit" id="btn-kirim"
                        class="md:hidden block rounded-lg bg-white text-[#1C1762] font-bold text-center p-2 px-16">Send
                        Message</button>
                    </div>
                </form>
            </div>

        </section>
        <!-- ==== section contact end ==== -->

        <script>
            const formKontak = document.getElementById('form-kontak');
            let isSending = false;
            let lastSentAt = 0;

            if (formKontak) {
                // 1. Sanitasi client-side: buang tag HTML agar tidak bisa injeksi <script> dsb.
                formKontak.querySelectorAll('input[name], textarea[name]').forEach((el) => {
                    el.addEventListener('input', () => {
                        el.value = el.value.replace(/<[^>]*>/g, '');
                    });
                });

                // 2. Batasi submit (client-side) + cegah double submit
                formKontak.addEventListener('submit', function (e) {
                    if (isSending) {
                        e.preventDefault();
                        return;
                    }

                    // Cooldown 30 detik antar kirim
                    if (Date.now() - lastSentAt < 30000) {
                        e.preventDefault();
                        Swal.fire({
                            title: 'Terlalu cepat!',
                            text: 'Tunggu 30 detik sebelum mengirim pesan lagi.',
                            icon: 'warning',
                            draggable: true
                        });
                        return;
                    }

                    const btns = Array.from(
                        document.querySelectorAll('#form-kontak button[type="submit"], button[form="form-kontak"]')
                    );

                    isSending = true;
                    lastSentAt = Date.now();

                    btns.forEach((btn) => {
                        btn.disabled = true;
                        btn.textContent = 'Mengirim...';
                    });

                    // Kirim form secara manual (hindari loop event)
                    formKontak.submit();
                });
            }
        </script>
    @endsection
</body>