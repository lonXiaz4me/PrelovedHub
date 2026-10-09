@props(['title' => null])

@php
    // Link to a named route if it exists yet, otherwise "#". Lets us add pages one step at a time.
    $to = fn (string $name) => \Illuminate\Support\Facades\Route::has($name) ? route($name) : '#';
    $settingsUrl = \Illuminate\Support\Facades\Route::has('settings')
        ? route('settings')
        : (auth()->check() ? route('profile.edit') : route('login'));

    $nav = [
        ['Discover', 'home', route('home'), request()->routeIs('home')],
        ['Browse & filter', 'filter', $to('browse'), request()->routeIs('browse')],
        ['My shop', 'user', $to('shop'), request()->routeIs('shop*')],
        ['Settings', 'settings', $settingsUrl, request()->routeIs('settings', 'profile.*')],
    ];
@endphp
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

    @include('partials.theme-init')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-canvas text-ink">

    {{-- Header --}}
    <header class="sticky top-0 z-40 border-b border-line bg-canvas/95 backdrop-blur">
        <div class="mx-auto flex max-w-shell items-center gap-3 px-4 py-3 sm:gap-5 sm:px-5 sm:py-4 lg:px-8">
            <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-2.5">
                <span class="flex size-8 items-center justify-center rounded-xl bg-forest text-cream sm:size-9">
                    <x-icon name="sparkle" class="size-4.5 sm:size-5" />
                </span>
                <span class="font-display text-lg font-semibold tracking-tight sm:text-xl">Preloved<span class="text-coral">Hub</span></span>
            </a>

            <form method="GET" action="{{ $to('browse') !== '#' ? route('browse') : route('home') }}" role="search"
                  class="relative mx-auto hidden w-full max-w-search md:block">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <label for="search-desktop" class="sr-only">{{ __('Search preloved items') }}</label>
                <x-icon name="search" class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-muted" />
                <input id="search-desktop" type="search" name="q" value="{{ request('q') }}" placeholder="{{ __('Search for something preloved') }}"
                       class="h-12 w-full rounded-full border border-line bg-surface pl-12 pr-4 text-sm outline-none transition focus:border-brand focus:ring-4 focus:ring-brand/10">
            </form>

            <div class="ml-auto flex shrink-0 items-center gap-2">
                <button type="button" aria-label="{{ __('Notifications') }}"
                        class="relative hidden size-11 items-center justify-center rounded-full border border-line bg-surface transition hover:border-brand hover:text-brand sm:flex">
                    <x-icon name="bell" />
                    <span class="absolute right-2.5 top-2.5 size-2 rounded-full bg-coral ring-2 ring-white"></span>
                </button>

                @auth
                    <a href="{{ $to('shop') }}" aria-label="{{ __('My shop') }}"
                       class="flex h-11 items-center gap-2 rounded-full border border-line bg-surface pl-1.5 pr-1.5 text-sm font-semibold transition hover:border-brand sm:pr-5">
                        <span class="flex size-8 items-center justify-center rounded-full bg-sage text-xs font-bold text-forest">{{ auth()->user()->initials }}</span>
                        <span class="hidden max-w-32 truncate sm:block">{{ auth()->user()->name }}</span>
                    </a>
                @else
                    <x-guest-actions />
                @endauth
            </div>
        </div>
    </header>

    <div class="mx-auto flex max-w-shell">

        {{-- Desktop sidebar --}}
        <aside class="sticky top-header hidden h-content w-sidebar shrink-0 flex-col justify-between border-r border-line px-6 py-8 lg:flex">
            <nav class="space-y-2" aria-label="{{ __('Primary navigation') }}">
                @foreach ($nav as [$label, $icon, $href, $active])
                    <a href="{{ $href }}"
                       class="{{ $active ? 'bg-sage text-forest' : 'text-muted hover:bg-surface hover:text-brand' }} flex w-full items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition">
                        <x-icon :name="$icon" />
                        <span>{{ __($label) }}</span>
                    </a>
                @endforeach

                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex w-full items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold text-muted transition hover:bg-surface hover:text-brand">
                            <x-icon name="logout" />
                            <span>{{ __('Log out') }}</span>
                        </button>
                    </form>
                @endauth
            </nav>

            <div class="rounded-3xl bg-forest p-5 text-cream">
                <span class="mb-6 flex size-10 items-center justify-center rounded-full bg-white/10">
                    <x-icon name="bag" />
                </span>
                <p class="font-display text-xl leading-tight">{{ __('Give it a second story.') }}</p>
                <p class="mt-2 text-xs leading-relaxed text-cream/65">{{ __('Clear some space and make a little extra.') }}</p>
                <a href="{{ $to('sell') }}" class="mt-5 flex w-full items-center justify-center gap-2 rounded-full bg-coral py-3 text-sm font-bold text-white transition hover:bg-coral-dark">
                    <x-icon name="plus" class="size-4" />
                    {{ __('Sell an item') }}
                </a>
            </div>
        </aside>

        <main class="min-w-0 flex-1 px-5 pb-28 pt-7 lg:px-8 lg:pb-12 lg:pt-8">
            {{ $slot }}
        </main>
    </div>

    {{-- Mobile bottom navigation --}}
    <nav class="fixed inset-x-0 bottom-0 z-50 border-t border-line bg-surface/95 px-5 pb-safe pt-2 backdrop-blur lg:hidden" aria-label="{{ __('Mobile navigation') }}">
        <div class="mx-auto flex max-w-md items-end justify-between">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-brand' : 'text-muted' }} flex w-12 flex-col items-center gap-1 py-2">
                <x-icon name="home" class="{{ request()->routeIs('home') ? 'fill-current' : '' }}" />
                <span class="text-tiny font-bold">{{ __('Home') }}</span>
            </a>
            <a href="{{ $to('browse') }}" class="{{ request()->routeIs('browse') ? 'text-brand' : 'text-muted' }} flex w-12 flex-col items-center gap-1 py-2">
                <x-icon name="filter" />
                <span class="text-tiny font-bold">{{ __('Explore') }}</span>
            </a>
            <a href="{{ $to('sell') }}" class="-mt-7 flex flex-col items-center gap-1">
                <span class="flex size-14 items-center justify-center rounded-full bg-coral text-white shadow-sell ring-4 ring-canvas">
                    <x-icon name="plus" class="size-6" />
                </span>
                <span class="text-tiny font-bold text-ink">{{ __('Sell') }}</span>
            </a>
            <a href="{{ $settingsUrl }}" class="{{ request()->routeIs('settings', 'profile.*') ? 'text-brand' : 'text-muted' }} flex w-12 flex-col items-center gap-1 py-2">
                <x-icon name="settings" />
                <span class="text-tiny font-bold">{{ __('Settings') }}</span>
            </a>
            <a href="{{ $to('shop') }}" class="{{ request()->routeIs('shop*') ? 'text-brand' : 'text-muted' }} flex w-12 flex-col items-center gap-1 py-2">
                <x-icon name="user" />
                <span class="text-tiny font-bold">{{ __('My shop') }}</span>
            </a>
        </div>
    </nav>
</body>
</html>
