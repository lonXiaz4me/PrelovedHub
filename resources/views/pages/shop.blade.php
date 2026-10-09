<x-layouts.marketplace :title="__('My shop')">
    <x-page-title :eyebrow="__('Your inventory')" :title="__(':name’s shop', ['name' => auth()->user()->name])"
                  :description="__('Your listings, sales, and shop details will live here.')" />

    <div class="mt-8 rounded-card border border-dashed border-line bg-surface px-6 py-16 text-center">
        <x-icon name="user" class="mx-auto size-7 text-muted" />
        <p class="mt-3 font-display text-xl font-semibold">{{ __('Your shop is coming together') }}</p>
        <p class="mt-1 text-sm text-muted">{{ __('This page is being built.') }}</p>
    </div>
</x-layouts.marketplace>
