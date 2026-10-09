<div class="my-6 flex items-center gap-3">
    <span class="h-px flex-1 bg-line"></span>
    <span class="text-xs text-muted">{{ __('or continue with') }}</span>
    <span class="h-px flex-1 bg-line"></span>
</div>

{{-- Placeholder: Google sign-in is not wired up yet --}}
<button type="button" aria-disabled="true" title="{{ __('Google sign-in is coming soon') }}"
        class="flex w-full cursor-not-allowed items-center justify-center gap-2 rounded-full border border-line bg-surface py-3 text-sm font-bold opacity-70">
    {{ __('Continue with Google') }}
    <span class="rounded-full bg-stone px-2 py-0.5 text-tiny font-bold text-muted">{{ __('Soon') }}</span>
</button>
