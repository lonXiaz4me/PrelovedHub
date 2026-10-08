@props(['eyebrow', 'title', 'description'])

<div>
    <p class="text-xs font-bold uppercase tracking-label text-coral">{{ $eyebrow }}</p>
    <h1 class="mt-2 font-display text-3xl font-semibold leading-none tracking-tight sm:text-hero">{{ $title }}</h1>
    <p class="mt-3 max-w-2xl text-sm leading-relaxed text-muted sm:mt-4 sm:text-base">{{ $description }}</p>
</div>
