@props(['listing'])

<article x-data="{ liked: {{ !empty($listing['liked']) ? 'true' : 'false' }} }" class="group min-w-0">
    <div class="relative aspect-card overflow-hidden rounded-card bg-stone">
        <img src="{{ $listing['image'] }}" alt="{{ $listing['title'] }}" loading="lazy"
             class="h-full w-full object-cover transition duration-500 group-hover:scale-105">

        <span class="absolute left-3 top-3 rounded-full bg-white/90 px-2.5 py-1.5 text-tiny font-bold text-forest shadow-sm backdrop-blur">
            {{ $listing['condition'] }}
        </span>

        <button type="button" @click="liked = !liked"
                :aria-label="liked ? 'Remove from saved' : 'Save item'"
                :class="liked ? 'bg-coral text-white' : 'bg-white/90 text-ink hover:text-coral'"
                class="absolute right-3 top-3 flex size-9 items-center justify-center rounded-full shadow-sm backdrop-blur transition">
            <x-icon name="heart" class="size-4.5" ::class="liked ? 'fill-current' : ''" />
        </button>
    </div>

    <div class="pt-3">
        <div class="flex items-start justify-between gap-2">
            <h3 class="line-clamp-1 text-sm font-semibold sm:text-base">{{ $listing['title'] }}</h3>
            <span class="shrink-0 font-display text-lg font-bold text-forest">{{ $listing['price'] }}</span>
        </div>

        <p class="mt-1 flex items-center gap-1 text-xs text-muted">
            <x-icon name="pin" class="size-3" /> {{ $listing['location'] }}
        </p>

        <div class="mt-3 flex items-center gap-2 border-t border-line pt-3">
            <span class="{{ $listing['accent'] }} flex size-6 items-center justify-center rounded-full text-tiny font-bold text-forest">
                {{ $listing['initials'] }}
            </span>
            <span class="truncate text-xs font-medium text-muted">{{ $listing['seller'] }}</span>
        </div>
    </div>
</article>
