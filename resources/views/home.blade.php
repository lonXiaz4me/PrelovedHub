<x-layouts.marketplace title="Discover">

    {{-- Hero --}}
    <div class="relative overflow-hidden rounded-hero bg-forest px-6 py-8 text-cream sm:px-10 sm:py-10">
        <div class="relative z-10 max-w-hero-copy">
            <div class="mb-5 inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1.5 text-xs font-semibold text-sage">
                <x-icon name="sparkle" class="size-3.5" />
                Thoughtfully found, happily reused
            </div>
            <h1 class="font-display text-hero-mobile leading-none tracking-tight sm:text-hero">
                Someone’s old favorite,
                <span class="text-sage"> your new find.</span>
            </h1>
            <p class="mt-5 max-w-lg text-sm leading-relaxed text-cream/70 sm:text-base">
                Discover one-of-a-kind pieces from real people near you. Better for your style, your wallet, and the planet.
            </p>
            <a href="#feed" class="mt-7 inline-flex items-center gap-3 rounded-full bg-cream px-5 py-3 text-sm font-bold text-forest transition hover:bg-white">
                Start exploring
                <x-icon name="arrow" class="size-4" />
            </a>
        </div>

        <div class="absolute -bottom-20 -right-8 size-hero-orb rounded-full border border-white/10 bg-sage/15"></div>
        <div class="absolute -right-6 top-6 rotate-6 rounded-3xl border border-white/15 bg-white/10 p-3 shadow-soft backdrop-blur sm:right-10">
            <div class="h-28 w-24 overflow-hidden rounded-2xl sm:h-36 sm:w-28">
                <img src="{{ $featured['image'] }}" alt="A curated preloved shop display" class="h-full w-full object-cover">
            </div>
            <div class="mt-2 flex items-center justify-between">
                <span class="text-xs font-semibold">Fresh find</span>
                <span class="rounded-full bg-coral px-2 py-1 text-tiny font-bold">{{ $featured['price'] }}</span>
            </div>
        </div>
    </div>

    {{-- Mobile search --}}
    <form method="GET" action="{{ route('home') }}" role="search" class="relative mt-6 block md:hidden">
        @if ($activeCategory !== 'For you')
            <input type="hidden" name="category" value="{{ $activeCategory }}">
        @endif
        <label for="search-mobile" class="sr-only">Search preloved items</label>
        <x-icon name="search" class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-muted" />
        <input id="search-mobile" type="search" name="q" value="{{ $q }}" placeholder="Search preloved items"
               class="h-12 w-full rounded-full border border-line bg-white pl-12 pr-4 text-sm outline-none focus:border-forest">
    </form>

    {{-- Feed --}}
    <section id="feed" class="mt-8 scroll-mt-28">
        <div class="flex items-end justify-between gap-5">
            <div>
                <p class="text-xs font-bold uppercase tracking-label text-coral">Curated for you</p>
                <h2 class="mt-1 font-display text-section font-semibold tracking-tight">Finds worth keeping</h2>
            </div>
            <a href="{{ route('home') }}" class="hidden items-center gap-2 text-sm font-semibold text-forest hover:text-coral sm:flex">
                View all <x-icon name="arrow" class="size-4" />
            </a>
        </div>

        {{-- Category chips --}}
        <div class="scrollbar-none -mx-5 mt-5 flex gap-2 overflow-x-auto px-5 pb-2 lg:mx-0 lg:px-0">
            @foreach ($categories as $category)
                <a href="{{ route('home', array_filter(['category' => $category === 'For you' ? null : $category, 'q' => $q ?: null])) }}"
                   class="{{ $activeCategory === $category ? 'border-forest bg-forest text-white' : 'border-line bg-white text-muted hover:border-forest hover:text-forest' }} shrink-0 rounded-full border px-4 py-2.5 text-sm font-semibold transition">
                    {{ $category }}
                </a>
            @endforeach
            <a href="#" class="flex shrink-0 items-center gap-2 rounded-full border border-line bg-white px-4 py-2.5 text-sm font-semibold text-muted transition hover:border-forest hover:text-forest">
                <x-icon name="filter" class="size-4" /> Filters
            </a>
        </div>

        @if ($listings->isNotEmpty())
            <div class="mt-5 grid grid-cols-2 gap-x-3 gap-y-7 sm:gap-x-5 lg:grid-cols-3">
                @foreach ($listings as $listing)
                    <x-listing-card :listing="$listing" />
                @endforeach
            </div>
        @else
            <div class="mt-6 rounded-card border border-dashed border-line bg-white py-16 text-center">
                <x-icon name="search" class="mx-auto size-7 text-muted" />
                <p class="mt-3 font-display text-xl font-semibold">No finds just yet</p>
                <p class="mt-1 text-sm text-muted">Try another search or category.</p>
            </div>
        @endif
    </section>

</x-layouts.marketplace>
