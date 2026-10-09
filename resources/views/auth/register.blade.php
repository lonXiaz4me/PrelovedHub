<x-layouts.auth :title="__('Sign up')" :eyebrow="__('Join the community')" :heading="__('Start your second story.')"
                :subheading="__('Create an account to find more, waste less, and sell simply.')">

    <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-4">
        @csrf

        <x-field :label="__('Full name')" name="name" required autofocus autocomplete="name" />
        <x-field :label="__('Email address')" name="email" type="email" required autocomplete="username" />
        <x-field :label="__('Password')" name="password" type="password" required autocomplete="new-password" />
        <x-field :label="__('Confirm password')" name="password_confirmation" type="password" required autocomplete="new-password" />

        <button type="submit" class="w-full rounded-full bg-forest py-3.5 text-sm font-bold text-white transition hover:bg-forest-dark">{{ __('Create my account') }}</button>
    </form>

    <x-auth-social />

    <p class="mt-7 text-center text-sm text-muted">
        {{ __('Already have an account?') }} <a href="{{ route('login') }}" class="font-bold text-coral">{{ __('Log in') }}</a>
    </p>
</x-layouts.auth>
