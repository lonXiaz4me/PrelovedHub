@props(['title' => null, 'eyebrow', 'heading', 'subheading' => null])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ? $title . ' · ' : '' }}{{ config('app.name', 'PrelovedHub') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-canvas text-ink">

    <header class="border-b border-line bg-canvas">
        <div class="mx-auto flex max-w-shell items-center gap-3 px-4 py-3 sm:gap-5 sm:px-5 sm:py-4 lg:px-8">
            <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-2.5">
                <span class="flex size-8 items-center justify-center rounded-xl bg-forest text-cream sm:size-9">
                    <x-icon name="sparkle" class="size-4.5 sm:size-5" />
                </span>
                <span class="font-display text-lg font-semibold tracking-tight sm:text-xl">Preloved<span class="text-coral">Hub</span></span>
            </a>
            <div class="ml-auto flex shrink-0 items-center gap-2">
                <x-guest-actions />
            </div>
        </div>
    </header>

    <main class="mx-auto grid min-h-[calc(100vh-5rem)] max-w-shell lg:grid-cols-[minmax(0,1fr)_minmax(26rem,0.85fr)]">
        <section class="flex items-start justify-center px-4 py-8 sm:items-center sm:px-10 sm:py-12">
            <div class="w-full max-w-md">
                <p class="text-xs font-bold uppercase tracking-label text-coral">{{ $eyebrow }}</p>
                <h1 class="mt-2 font-display text-3xl font-semibold leading-none sm:text-hero">{{ $heading }}</h1>
                @if ($subheading)
                    <p class="mt-4 text-sm text-muted">{{ $subheading }}</p>
                @endif

                {{ $slot }}
            </div>
        </section>

        <aside class="relative hidden overflow-hidden bg-forest p-12 text-cream lg:flex lg:flex-col lg:justify-end">
            <img src="https://images.unsplash.com/photo-1453486030486-0a5ffcd82cd9?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&q=82&w=1400"
                 alt="A rack of curated preloved clothing"
                 class="absolute inset-0 h-full w-full object-cover opacity-35 mix-blend-luminosity">
            <div class="absolute inset-0 bg-forest/55"></div>
            <div class="relative max-w-md">
                <x-icon name="sparkle" class="size-9 text-sage" />
                <blockquote class="mt-6 font-display text-4xl leading-tight">“The best pieces already have a little history.”</blockquote>
                <p class="mt-5 text-sm text-cream/70">Buy thoughtfully. Sell easily. Keep good things moving.</p>
            </div>
        </aside>
    </main>
</body>
</html>
