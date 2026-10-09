<x-layouts.marketplace :title="__('Sell an item')">
    <x-page-title :eyebrow="__('Pass it on')" :title="__('Sell an item')"
                  :description="__('A few thoughtful details help your piece find the right new home.')" />

    <div class="mt-8 rounded-card border border-dashed border-line bg-surface px-6 py-16 text-center">
        <x-icon name="plus" class="mx-auto size-7 text-muted" />
        <p class="mt-3 font-display text-xl font-semibold">{{ __('The listing form is on its way') }}</p>
        <p class="mt-1 text-sm text-muted">{{ __('This page is being built.') }}</p>
    </div>
</x-layouts.marketplace>
