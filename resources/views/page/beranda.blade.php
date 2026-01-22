<!-- inline css -->
<style>
#hero-image{
    animation: float 3s ease-in-out infinite;
}
@keyframes float {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-20px);
    }
}
</style>
<body class="overflow-x-hidden">
        @extends('layouts.app') @section('content')
        <!-- ======= Hero Section ========= -->
        <section
            class="text-whiterelative overflow-hidden min-h-screen flex flex-wrap-reverse md:flex-row justify-center md:items-center md:pt-16 pt-32 gap-8"
        >
            <!-- Content -->
            <div class="flex-1 p-2 z-10">
                <h1
                    class="text-4xl md:text-6xl font-bold text-white leading-snug"
                >
                    Transforming ideas into impactful
                    <span class="">digital experiences.</span>
                </h1>

                <p
                    class="text-white mt-4 md:mt-8 text-base md:text-lg leading-relaxed"
                >
                    Neuron Production is a digital agency focused on crafting
                    seamless websites, intuitive user experiences, and impactful
                    visual designs.
                </p>

                <div class="flex flex-wrap gap-4 mt-8">
                    <a
                        href="#"
                        class="bg-purple-700 text-white px-6 py-3 rounded-tr-[20px] rounded-bl-[20px] shadow hover:bg-purple-800 transition"
                    >
                        Let’s Build Your Website
                    </a>
                    <a
                        href="#"
                        class="border border-purple-700 text-purple-700 px-6 py-3 rounded-tr-[20px] rounded-bl-[20px] hover:bg-purple-700 hover:text-white transition"
                    >
                        View Our Works
                    </a>
                </div>
            </div>

            <!-- img yaa ni -->
            <div class="flex justify-center md:justify-end items-center z-10" id="hero-image">
                <img
                    src="{{ asset('images/page/iconhero.png') }}"
                    alt="Hero Image"
                    class="w-1/2 md:w-1/3 lg:w-[400px] opacity-80"
                />
            </div>
        </section>

        <!-- ==== section our pricing ===== -->
        <section class="mt-10 md:mt-4" id="pricing">
            <h1 class="text-3xl md:text-5xl text-white font-bold text-center">
                Simple Pricing for Every Business
            </h1>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 py-10 md:py-16">
                <!-- card -->
                <div
                    class="bg-gradient-to-r from-[#2E287E] to-[#181642] p-2 rounded-lg flex gap-4 items-center"
                >
                    <div
                        class="border-2 border-white rounded-lg p-4 flex flex-col gap-10 w-full h-full"
                    >
                        <div class="flex text-white flex-col">
                            <span class="mb-2">UMKM Package</span>
                            <span class="text-3xl font-bold">Rp400,000</span>
                        </div>

                        <ul
                            class="text-sm text-white mt-2 list-disc pl-5 space-y-1"
                        >
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
                <div
                    class="bg-gradient-to-r from-[#2E287E] to-[#181642] p-2 rounded-lg flex gap-4 items-center"
                >
                    <div
                        class="border-2 border-white rounded-lg p-4 flex flex-col gap-10 w-full h-full"
                    >
                        <div class="flex text-white flex-col">
                            <span class="mb-2">Standard Package</span>
                            <span class="text-3xl font-bold"
                                >Rp500,000-Rp1,500,000</span
                            >
                        </div>

                        <ul
                            class="text-sm text-white mt-2 list-disc pl-5 space-y-1"
                        >
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
                <div
                    class="bg-gradient-to-r from-[#2E287E] to-[#181642] p-2 rounded-lg flex gap-4 items-center"
                >
                    <div
                        class="border-2 border-white rounded-lg p-4 flex flex-col gap-10 w-full h-full"
                    >
                        <div class="flex text-white flex-col">
                            <span class="mb-2">Professional Package</span>
                            <span class="text-3xl font-bold"
                                >Rp1,500,000-3,700,000</span
                            >
                        </div>

                        <ul
                            class="text-sm text-white mt-2 list-disc pl-5 space-y-1"
                        >
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
        <section class="py-8 md:py-20" id="projects">
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
                    <img
                        src="{{ asset('images/page/icon-project1.png') }}"
                        alt=""
                    />
                </div>
            </div>

            <!-- box grid -->
            <div class="flex gap-8 flex-col lg:flex-nowrap">
                <!-- Grid -->
                <div class="flex-1 gap-8">
                    <div class="flex gap-8 mb-8">
                        <!-- Card -->
                        <div
                            class="flex-1 rounded-2xl overflow-hidden bg-white/5 backdrop-blur hover:scale-[1.02] transition">
                            <img src="{{ asset('images/page/img-project-3.png') }}" alt="" class="h-full w-full object-cover">
                          </div>

                        <!-- Card -->
                        <div
                            class="md:w-[100px] flex-1 rounded-2xl overflow-hidden bg-white/5 backdrop-blur hover:scale-[1.02] transition">
                            <img src="{{ asset('images/page/img-project-2.png') }}" class="h-full w-full object-cover" alt="">
                      </div>
                    </div>

                    <div class="flex gap-8">
                        <!-- card -->
                        <div
                            class="lg:flex hidden rounded-2xl overflow-hidden items-center backdrop-blur hover:scale-[1.02] transition"
                        >
                            <img
                                src="{{ asset('images/page/icon-project2.png') }}"
                                alt=""
                                class="w-full h-[200px] object-cover"
                            />
                        </div>
                        <!-- Card -->
                        <div
                            class="flex-1 rounded-2xl overflow-hidden bg-white/5 backdrop-blur hover:scale-[1.02] transition"
                            style="background-image: url('{{ asset('images/page/img-project-3.png') }}'); background-size: cover; background-position: center;"
                        >
                            <img
                                src="https://source.unsplash.com/600x400/?portrait,ui"
                                alt=""
                                class="w-full h-52 object-cover"
                            />
                        </div>
                    </div>
                </div>

                <!-- Card (lebih tinggi di desktop) -->
                <div
                    class="w-[100%] md:w-[400px] rounded-2xl">
                    <img src="{{ asset('images/page/img-project-long.png') }}" class="h-full w-full object-cover bg-center" alt="">
                </div>
            </div>
        </section>
        <!-- ==== section project end ==== -->

        <!-- ==== section contact ===== -->
         <section class="grid md:grid-cols-2 py-8 md:py-20 gap-10" id="contact">
              <div class="text-white flex flex-col gap-4 md:gap-16">
                <h1>Contact Us</h1>  
                <h2 class="md:text-5xl text-3xl font-bold mb-0 md:mb-32">Let’s discuss your project and bring your ideas to life</h2>
                <button class="w-[fit-content] hidden md:flex rounded-tr-3xl rounded-bl-3xl text-end p-2 px-16 bg-gradient-to-r from-[#363089] to-[#1C1762]">Send Message</button>
              </div>
              <div>
                <form action="" class="flex flex-col gap-4 border-white/30 p-6 rounded-lg bg-gradient-to-r from-[#363089] to-[#1C1762]">
                 <label class="text-white">Name</label>              
                <input class="bg-transparent border rounded-lg p-4" type="text" placeholder="Your Name"/>
                 <label class="text-white">Email</label>              
                  <input class="bg-transparent border rounded-lg p-4" type="email" placeholder="Your Email"/>
                  <label class="text-white">Message</label>
                  <textarea class="bg-transparent border" name="" id="" cols="15" rows="10"></textarea>
                  <button type="submit" class="md:hidden block rounded-lg bg-white text-center p-2 px-16">Send Message</button>
                </form>
              </div>
         </section>
        <!-- ==== section contact end ==== -->
        @endsection
    </body>
