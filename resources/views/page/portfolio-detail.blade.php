@extends('layouts.app')

@section('content')
    <style>
        .filter-btn.active {
            background: linear-gradient(to right, #7c3aed, #5b21b6);
            color: #fff;
            border-color: transparent;
        }
    </style>

    <section class="min-h-[70vh] py-6 lg:mt-10 md:py-20" data-aos="zoom-in">

        {{-- Tombol kembali --}}
        <a href="/#projects"
            class="inline-flex items-center gap-2 text-white/70 hover:text-white transition mb-8">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M19 12H5M12 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Kembali ke Portfolio
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-start">
            {{-- Gambar --}}
            <div class="rounded-2xl overflow-hidden bg-white/5 backdrop-blur">
                <img src="{{ asset('storage/' . $portfolio->img) }}" alt="{{ $portfolio->title }}"
                    class="w-full h-auto object-cover" />
            </div>

            {{-- Detail --}}
            <div class="text-white flex flex-col gap-6">
                <span
                    class="inline-block w-fit text-sm font-semibold rounded-full px-4 py-1.5 bg-purple-700 text-white">
                    {{ \App\Support\PortfolioCategories::label($portfolio->category) }}
                </span>

                <h1 class="text-3xl md:text-5xl font-bold leading-tight">{{ $portfolio->title }}</h1>

                <div class="border-t border-white/15 pt-6">
                    <p class="text-gray-200 leading-relaxed whitespace-pre-line">{{ $portfolio->desc }}</p>
                </div>
            </div>
        </div>

        {{-- Filter kategori + daftar portfolio (di bawah konten detail) --}}
        <div class="mt-20 [content-visibility:auto] [contain-intrinsic-size:auto_900px]">
            <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
                <h2 class="text-white text-2xl md:text-3xl font-bold">Portfolio</h2>

                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('portfolio.show', $portfolio) }}"
                        class="filter-btn border border-white/20 px-4 py-2 rounded-full text-sm transition {{ $kategori === 'all' ? 'active text-white' : 'text-white/70 hover:text-white hover:border-white/50' }}">
                        Semua
                    </a>
                    @foreach ($categories as $key => $label)
                        <a href="{{ route('portfolio.show', ['portfolio' => $portfolio, 'kategori' => $key]) }}"
                            class="filter-btn border border-white/20 px-4 py-2 rounded-full text-sm transition {{ $kategori === $key ? 'active text-white' : 'text-white/70 hover:text-white hover:border-white/50' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($items as $item)
                    <a href="{{ route('portfolio.show', $item) }}"
                        class="group relative rounded-2xl overflow-hidden bg-white/5 backdrop-blur hover:scale-[1.02] transition duration-300 aspect-[4/3]">
                        <img src="{{ asset('storage/' . $item->img) }}" alt="{{ $item->title }}"
                            class="w-full h-full object-cover" loading="lazy" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent opacity-0 group-hover:opacity-100 transition flex flex-col justify-end p-4">
                            <span
                                class="inline-block w-fit text-xs font-semibold rounded-full px-3 py-1 mb-2 bg-purple-600/90 text-white">
                                {{ \App\Support\PortfolioCategories::label($item->category) }}
                            </span>
                            <h3 class="text-white font-semibold">{{ $item->title }}</h3>
                        </div>
                    </a>
                @empty
                    <p class="text-gray-400 col-span-full text-center py-10">
                        Tidak ada portfolio untuk kategori ini.
                    </p>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-10">
                {{ $items->links() }}
            </div>
        </div>
    </section>
@endsection
