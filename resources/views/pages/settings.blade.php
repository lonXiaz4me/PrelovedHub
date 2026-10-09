@php
    $savedLocale = request()->cookie('locale');
    $currentLocale = in_array($savedLocale, ['en', 'ms'], true) ? $savedLocale : 'auto';
    $choiceBase = 'rounded-xl border px-4 py-3 text-sm font-bold transition';
    $choiceOn = 'border-brand bg-brand/10 text-brand';
    $choiceOff = 'border-line text-muted hover:border-brand hover:text-brand';
@endphp

<x-layouts.marketplace :title="__('Settings')">
    <x-page-title :eyebrow="__('Your preferences')" :title="__('Settings')"
                  :description="__('Manage your account, notifications, and marketplace preferences.')" />

    <div class="mt-8 grid max-w-3xl gap-6">

        {{-- Appearance --}}
        <section class="rounded-card border border-line bg-surface p-5 sm:p-7">
            <h2 class="font-display text-xl font-semibold">{{ __('Appearance') }}</h2>
            <p class="mt-1 text-sm text-muted">{{ __('Choose how PrelovedHub looks on this device.') }}</p>

            <div x-data="{
                    mode: (function () { try { return localStorage.getItem('theme') || 'system'; } catch (e) { return 'system'; } })(),
                    set(value) {
                        this.mode = value;
                        try { value === 'system' ? localStorage.removeItem('theme') : localStorage.setItem('theme', value); } catch (e) {}
                        if (window.applyTheme) window.applyTheme();
                    }
                 }"
                 role="group" aria-label="{{ __('Theme') }}" class="mt-5 grid grid-cols-3 gap-2">
                @foreach (['system' => 'System', 'light' => 'Light', 'dark' => 'Dark'] as $value => $label)
                    <button type="button" @click="set('{{ $value }}')" :aria-pressed="mode === '{{ $value }}'"
                            :class="mode === '{{ $value }}' ? '{{ $choiceOn }}' : '{{ $choiceOff }}'"
                            class="{{ $choiceBase }}">{{ __($label) }}</button>
                @endforeach
            </div>
            <p class="mt-3 text-xs text-muted">{{ __('System follows your device setting automatically.') }}</p>
        </section>

        {{-- Language --}}
        <section class="rounded-card border border-line bg-surface p-5 sm:p-7">
            <h2 class="font-display text-xl font-semibold">{{ __('Language') }}</h2>
            <p class="mt-1 text-sm text-muted">{{ __('Choose the language used across PrelovedHub.') }}</p>

            <form method="POST" action="{{ route('locale.update') }}" class="mt-5 grid gap-2 sm:grid-cols-3">
                @csrf
                @foreach (['auto' => __('Automatic'), 'en' => 'English', 'ms' => 'Bahasa Malaysia'] as $value => $label)
                    <button type="submit" name="locale" value="{{ $value }}"
                            aria-pressed="{{ $currentLocale === $value ? 'true' : 'false' }}"
                            class="{{ $choiceBase }} {{ $currentLocale === $value ? $choiceOn : $choiceOff }}">{{ $label }}</button>
                @endforeach
            </form>
            <p class="mt-3 text-xs text-muted">{{ __('Automatic follows your browser language.') }}</p>
        </section>

        {{-- Account --}}
        <section class="rounded-card border border-line bg-surface p-5 sm:p-7">
            @guest
                <h2 class="font-display text-xl font-semibold">{{ __('Log in to manage your account') }}</h2>
                <p class="mt-1 text-sm text-muted">{{ __('Profile details, notifications, and password settings are available once you’re signed in.') }}</p>
                <div class="mt-5 flex flex-wrap gap-3">
                    <a href="{{ route('login') }}" class="rounded-full bg-forest px-5 py-2.5 text-sm font-bold text-white transition hover:bg-forest-dark">{{ __('Log in') }}</a>
                    <a href="{{ route('register') }}" class="rounded-full border border-line px-5 py-2.5 text-sm font-bold transition hover:border-brand">{{ __('Create an account') }}</a>
                </div>
            @else
                <h2 class="font-display text-xl font-semibold">{{ __('Account') }}</h2>
                <p class="mt-1 text-sm text-muted">{{ __('Until the full settings are ready, you can update your name, email, and password on the profile page.') }}</p>
                <a href="{{ route('profile.edit') }}" class="mt-5 inline-flex rounded-full bg-forest px-5 py-2.5 text-sm font-bold text-white transition hover:bg-forest-dark">{{ __('Open profile') }}</a>
                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button type="submit" class="rounded-full border border-line px-5 py-2.5 text-sm font-bold transition hover:border-brand">{{ __('Log out') }}</button>
                </form>
            @endguest
        </section>
    </div>
</x-layouts.marketplace>
