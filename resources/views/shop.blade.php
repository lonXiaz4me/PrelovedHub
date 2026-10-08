<x-layouts.marketplace title="My shop">
    <x-page-title eyebrow="Your inventory" title="{{ auth()->user()->name }}’s shop"
                  description="Your listings, sales, and shop details will live here." />

    <div class="mt-8 rounded-card border border-dashed border-line bg-white px-6 py-16 text-center">
        <x-icon name="user" class="mx-auto size-7 text-muted" />
        <p class="mt-3 font-display text-xl font-semibold">Your shop is coming together</p>
        <p class="mt-1 text-sm text-muted">This page is being built.</p>
    </div>
</x-layouts.marketplace>
