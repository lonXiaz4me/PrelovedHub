<x-layouts.auth :title="__('Forgot password')" :eyebrow="__('Forgot password')" :heading="__('Let’s get you back in.')"
                :subheading="__('Enter your email and we’ll send you a link to choose a new password.')">

    @if (session('status'))
        <p class="mt-6 rounded-xl bg-sage/60 px-4 py-3 text-sm font-semibold text-forest">{{ session('status') }}</p>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="mt-8 space-y-4">
        @csrf

        <x-field :label="__('Email address')" name="email" type="email" required autofocus />

        <button type="submit" class="w-full rounded-full bg-forest py-3.5 text-sm font-bold text-white transition hover:bg-forest-dark">{{ __('Email reset link') }}</button>
    </form>

    <p class="mt-7 text-center text-sm text-muted">
        {{ __('Remembered it?') }} <a href="{{ route('login') }}" class="font-bold text-coral">{{ __('Log in') }}</a>
    </p>
</x-layouts.auth>
