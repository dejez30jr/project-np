<!DOCTYPE html>

<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Engineered for Digital Supremacy</title>
<!-- Tailwind CSS CDN with plugins -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            midnight: '#070913',
            'midnight-card': '#0b0e1b',
            'midnight-border': '#1c2237',
            'card-border': '#1e2438',
            accent: {
              violet: '#a855f7',
              purple: '#9333ea',
              dark: '#581c87'
            }
          },
          fontFamily: {
            sans: ['Inter', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'sans-serif']
          }
        }
      }
    }
  </script>
<!-- Typography and Base Styles -->
<style data-purpose="typography">
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
    
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background-color: #070913;
      color: #f8fafc;
      overflow-x: hidden;
    }

    .gradient-purple-text {
      background: linear-gradient(135deg, #c084fc 0%, #a855f7 50%, #9333ea 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
  </style>
<!-- Subtle glow effects & container highlights -->
<style data-purpose="decorative-effects">
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
</head>
<body class="bg-midnight min-h-screen text-slate-300 selection:bg-purple-900 selection:text-white">
<!-- Background decorative ambient lighting -->
<div aria-hidden="true" class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
<div class="absolute -top-40 -left-40 w-96 h-96 bg-purple-900/20 rounded-full blur-3xl"></div>
<div class="absolute top-[40%] -right-40 w-96 h-96 bg-indigo-950/25 rounded-full blur-3xl"></div>
<div class="absolute -bottom-40 left-1/3 w-[500px] h-[500px] bg-purple-950/20 rounded-full blur-3xl"></div>
</div>
<main class="relative z-10 max-w-6xl mx-auto px-5 py-12 lg:py-20 flex flex-col gap-24 lg:gap-32">
<!-- BEGIN: WhyChooseUsSection -->
<section aria-labelledby="why-choose-us-heading" class="w-full">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
<!-- Left Column: Title, Narrative & Statistics -->
<div class="lg:col-span-6 flex flex-col items-start pr-0 lg:pr-6" data-purpose="intro-column">
<!-- Category Pill -->
<div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-950/40 border border-purple-800/40 mb-8" data-purpose="section-badge">
<span class="w-1.5 h-1.5 rounded-full bg-purple-400 glow-dot"></span>
<span class="text-xs font-bold tracking-wider text-purple-300 uppercase">Why Choose Us</span>
</div>
<!-- Main Bold Headline -->
<h1 class="text-4xl sm:text-5xl lg:text-[54px] font-extrabold tracking-tight text-white leading-[1.08] mb-6" id="why-choose-us-heading">
            Engineered for<br/>digital<br/>
<span class="gradient-purple-text">supremacy.</span>
</h1>
<!-- Descriptive Subtitle -->
<p class="text-slate-400 text-sm sm:text-base leading-relaxed max-w-lg mb-12">
            Combining strategic design, high-speed engineering, and tailored visual narratives that empower brand growth without cookie-cutter limitations.
          </p>
<!-- Divider line -->
<div class="w-full border-t border-slate-800/80 mb-10"></div>
<!-- Key Metrics / Statistics Row -->
<div class="grid grid-cols-3 gap-6 sm:gap-8 w-full" data-purpose="metrics-counter">
<div>
<div class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">99.4%</div>
<div class="text-xs text-slate-400 mt-1.5 font-medium">On-time Delivery</div>
</div>
<div>
<div class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">2.4×</div>
<div class="text-xs text-slate-400 mt-1.5 font-medium">Average ROI Growth</div>
</div>
<div>
<div class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">100%</div>
<div class="text-xs text-slate-400 mt-1.5 font-medium">Tailored Codebase</div>
</div>
</div>
</div>
<!-- Right Column: Numbered Value Propositions -->
<div class="lg:col-span-6 flex flex-col divide-y divide-slate-800/80" data-purpose="value-propositions">
<!-- Item 01 -->
<article class="pb-8 first:pt-0 pt-8 group transition duration-200">
<div class="flex items-start justify-between gap-4">
<div class="flex items-baseline gap-2.5">
<span class="text-xs font-bold text-purple-400 tracking-wider">01</span>
<h3 class="text-lg font-bold text-white tracking-tight group-hover:text-purple-300 transition-colors">
                  Creative &amp; Tailored UI/UX
                </h3>
</div>
<div class="shrink-0 w-9 h-9 rounded-full bg-purple-950/60 border border-purple-700/30 flex items-center justify-center text-purple-300 group-hover:border-purple-500/50 transition">
<!-- Sparkle / Grid Glyph Icon -->
<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" viewbox="0 0 24 24">
<path d="M12 3v3m0 12v3M3 12h3m12 0h3M5.6 5.6l2.1 2.1m8.6 8.6l2.1 2.1M5.6 18.4l2.1-2.1m8.6-8.6l2.1-2.1"></path>
</svg>
</div>
</div>
<p class="text-xs sm:text-sm text-slate-400 leading-relaxed mt-2.5 max-w-xl">
              Distinctive, human-centric interfaces specifically crafted around your brand's DNA and target audience. No rigid stock templates.
            </p>
<div class="flex items-center gap-2 mt-3.5 text-xs text-slate-300 font-medium">
<span class="w-1.5 h-1.5 bg-purple-500 rounded-none inline-block"></span>
<span>Pixel Perfection Guarantee</span>
</div>
</article>
<!-- Item 02 -->
<article class="py-8 group transition duration-200">
<div class="flex items-start justify-between gap-4">
<div class="flex items-baseline gap-2.5">
<span class="text-xs font-bold text-purple-400 tracking-wider">02</span>
<h3 class="text-lg font-bold text-white tracking-tight group-hover:text-purple-300 transition-colors">
                  High Performance Engineering
                </h3>
</div>
<div class="shrink-0 w-9 h-9 rounded-full bg-purple-950/60 border border-purple-700/30 flex items-center justify-center text-purple-300 group-hover:border-purple-500/50 transition">
<!-- Lightning / Zap Icon -->
<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" viewbox="0 0 24 24">
<polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
</svg>
</div>
</div>
<p class="text-xs sm:text-sm text-slate-400 leading-relaxed mt-2.5 max-w-xl">
              Lightning-fast load speeds, SEO-optimized structure, and pristine code built natively for mobile responsiveness and fluid interactions.
            </p>
<div class="flex items-center gap-2 mt-3.5 text-xs text-slate-300 font-medium">
<span class="w-1.5 h-1.5 bg-purple-500 rounded-none inline-block"></span>
<span>Core Web Vitals Ready</span>
</div>
</article>
<!-- Item 03 -->
<article class="py-8 group transition duration-200">
<div class="flex items-start justify-between gap-4">
<div class="flex items-baseline gap-2.5">
<span class="text-xs font-bold text-purple-400 tracking-wider">03</span>
<h3 class="text-lg font-bold text-white tracking-tight group-hover:text-purple-300 transition-colors">
                  End-to-End Product Delivery
                </h3>
</div>
<div class="shrink-0 w-9 h-9 rounded-full bg-purple-950/60 border border-purple-700/30 flex items-center justify-center text-purple-300 group-hover:border-purple-500/50 transition">
<!-- Stack / Layers Icon -->
<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" viewbox="0 0 24 24">
<path d="m12 2 10 5-10 5L2 7l10-5Z"></path>
<path d="m2 17 10 5 10-5"></path>
<path d="m2 12 10 5 10-5"></path>
</svg>
</div>
</div>
<p class="text-xs sm:text-sm text-slate-400 leading-relaxed mt-2.5 max-w-xl">
              Comprehensive solutions spanning strategic research, wireframing, custom development, strict QA testing, and frictionless deployment.
            </p>
<div class="flex items-center gap-2 mt-3.5 text-xs text-slate-300 font-medium">
<span class="w-1.5 h-1.5 bg-purple-500 rounded-none inline-block"></span>
<span>Full Lifecycle Support</span>
</div>
</article>
<!-- Item 04 -->
<article class="pt-8 group transition duration-200">
<div class="flex items-start justify-between gap-4">
<div class="flex items-baseline gap-2.5">
<span class="text-xs font-bold text-purple-400 tracking-wider">04</span>
<h3 class="text-lg font-bold text-white tracking-tight group-hover:text-purple-300 transition-colors">
                  Business &amp; ROI Driven
                </h3>
</div>
<div class="shrink-0 w-9 h-9 rounded-full bg-purple-950/60 border border-purple-700/30 flex items-center justify-center text-purple-300 group-hover:border-purple-500/50 transition">
<!-- Growth Chart / Analytics Icon -->
<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" viewbox="0 0 24 24">
<path d="M3 3v18h18"></path>
<path d="m19 9-5 5-4-4-3 3"></path>
</svg>
</div>
</div>
<p class="text-xs sm:text-sm text-slate-400 leading-relaxed mt-2.5 max-w-xl">
              Strategic user funnels designed to maximize conversion rates, inbound client trust, and tangible revenue growth across touchpoints.
            </p>
<div class="flex items-center gap-2 mt-3.5 text-xs text-slate-300 font-medium">
<span class="w-1.5 h-1.5 bg-purple-500 rounded-none inline-block"></span>
<span>Conversion Focused Architecture</span>
</div>
</article>
</div>
</div>
</section>
<!-- END: WhyChooseUsSection -->
<!-- BEGIN: OurServicesSection -->
<section aria-labelledby="our-services-heading" class="w-full flex flex-col items-center">
<!-- Center Category Badge -->
<div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-950/40 border border-purple-800/40 mb-6" data-purpose="services-badge">
<span class="w-1.5 h-1.5 rounded-full bg-purple-400 glow-dot"></span>
<span class="text-xs font-bold tracking-wider text-purple-300 uppercase">Our Services</span>
</div>
<!-- Centered Section Title -->
<h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white text-center tracking-tight leading-tight mb-4" id="our-services-heading">
        Services Crafted for <span class="gradient-purple-text">Modern<br class="hidden sm:inline"/> Growth</span>
</h2>
<!-- Centered Subtitle -->
<p class="text-slate-400 text-sm sm:text-base text-center max-w-xl mb-12">
        Tailored digital expertise to accelerate your brand authority and market reach.
      </p>
<!-- Services Cards Stack -->
<div class="w-full flex flex-col gap-4" data-purpose="services-list">
<!-- Service Card 1: Web Development -->
<div class="service-card rounded-2xl p-5 sm:p-7 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
<div class="flex items-start gap-4 sm:gap-5 max-w-2xl">
<!-- Icon Box -->
<div class="shrink-0 w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-purple-950/80 border border-purple-600/40 flex items-center justify-center text-purple-300 shadow-inner">
<svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24">
<polyline points="16 18 22 12 16 6"></polyline>
<polyline points="8 6 2 12 8 18"></polyline>
</svg>
</div>
<!-- Info Text -->
<div>
<h3 class="text-base sm:text-lg font-bold text-white tracking-tight mb-1.5">
                Web Development
              </h3>
<p class="text-xs sm:text-sm text-slate-400 leading-relaxed">
                Custom responsive websites, landing pages, and web apps built with modern tech stacks for ultimate speed and security.
              </p>
</div>
</div>
<!-- Feature Tag Pills -->
<div class="flex flex-wrap lg:justify-end items-center gap-2 lg:max-w-md shrink-0">
<div class="pill-tag px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs text-slate-200">
<svg class="w-3.5 h-3.5 text-purple-400" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" viewbox="0 0 24 24">
<polyline points="20 6 9 17 4 12"></polyline>
</svg>
<span>Landing Pages</span>
</div>
<div class="pill-tag px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs text-slate-200">
<svg class="w-3.5 h-3.5 text-purple-400" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" viewbox="0 0 24 24">
<polyline points="20 6 9 17 4 12"></polyline>
</svg>
<span>Company Profile</span>
</div>
<div class="pill-tag px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs text-slate-200">
<svg class="w-3.5 h-3.5 text-purple-400" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" viewbox="0 0 24 24">
<polyline points="20 6 9 17 4 12"></polyline>
</svg>
<span>Custom Web Apps</span>
</div>
</div>
</div>
<!-- Service Card 2: UI/UX Product Design -->
<div class="service-card rounded-2xl p-5 sm:p-7 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
<div class="flex items-start gap-4 sm:gap-5 max-w-2xl">
<!-- Icon Box -->
<div class="shrink-0 w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-purple-950/80 border border-purple-600/40 flex items-center justify-center text-purple-300 shadow-inner">
<svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24">
<path d="m12 19 7-7 3 3-7 7-3-3z"></path>
<path d="m18 13-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"></path>
<path d="m2 2 7.586 7.586"></path>
<circle cx="11" cy="11" r="2"></circle>
</svg>
</div>
<!-- Info Text -->
<div>
<h3 class="text-base sm:text-lg font-bold text-white tracking-tight mb-1.5">
                UI/UX Product Design
              </h3>
<p class="text-xs sm:text-sm text-slate-400 leading-relaxed">
                Intuitive interfaces and thoughtful user journeys created in Figma, complete with prototypes and scalable design systems.
              </p>
</div>
</div>
<!-- Feature Tag Pills -->
<div class="flex flex-wrap lg:justify-end items-center gap-2 lg:max-w-md shrink-0">
<div class="pill-tag px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs text-slate-200">
<svg class="w-3.5 h-3.5 text-purple-400" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" viewbox="0 0 24 24">
<polyline points="20 6 9 17 4 12"></polyline>
</svg>
<span>Mobile &amp; Web Wireframing</span>
</div>
<div class="pill-tag px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs text-slate-200">
<svg class="w-3.5 h-3.5 text-purple-400" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" viewbox="0 0 24 24">
<polyline points="20 6 9 17 4 12"></polyline>
</svg>
<span>Interactive Prototypes</span>
</div>
<div class="pill-tag px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs text-slate-200">
<svg class="w-3.5 h-3.5 text-purple-400" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" viewbox="0 0 24 24">
<polyline points="20 6 9 17 4 12"></polyline>
</svg>
<span>Design Systems</span>
</div>
</div>
</div>
<!-- Service Card 3: Graphic Design & Branding -->
<div class="service-card rounded-2xl p-5 sm:p-7 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
<div class="flex items-start gap-4 sm:gap-5 max-w-2xl">
<!-- Icon Box -->
<div class="shrink-0 w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-purple-950/80 border border-purple-600/40 flex items-center justify-center text-purple-300 shadow-inner">
<svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24">
<circle cx="12" cy="12" r="10"></circle>
<line x1="2" x2="22" y1="12" y2="12"></line>
<path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
</svg>
</div>
<!-- Info Text -->
<div>
<h3 class="text-base sm:text-lg font-bold text-white tracking-tight mb-1.5">
                Graphic Design &amp; Branding
              </h3>
<p class="text-xs sm:text-sm text-slate-400 leading-relaxed">
                Memorable visual identities, digital promotional posters, banner campaigns, and distinctive brand assets.
              </p>
</div>
</div>
<!-- Feature Tag Pills -->
<div class="flex flex-wrap lg:justify-end items-center gap-2 lg:max-w-md shrink-0">
<div class="pill-tag px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs text-slate-200">
<svg class="w-3.5 h-3.5 text-purple-400" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" viewbox="0 0 24 24">
<polyline points="20 6 9 17 4 12"></polyline>
</svg>
<span>Brand Guidelines &amp; Logo</span>
</div>
<div class="pill-tag px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs text-slate-200">
<svg class="w-3.5 h-3.5 text-purple-400" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" viewbox="0 0 24 24">
<polyline points="20 6 9 17 4 12"></polyline>
</svg>
<span>Marketing Poster &amp; Flyer</span>
</div>
<div class="pill-tag px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs text-slate-200">
<svg class="w-3.5 h-3.5 text-purple-400" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" viewbox="0 0 24 24">
<polyline points="20 6 9 17 4 12"></polyline>
</svg>
<span>Social Media Kits</span>
</div>
</div>
</div>
</div>
</section>
<!-- END: OurServicesSection -->
</main>
</body></html>