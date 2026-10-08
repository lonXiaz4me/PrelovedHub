<x-layouts.auth title="Sign up" eyebrow="Join the community" heading="Start your second story."
                subheading="Create an account to find more, waste less, and sell simply.">

    <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-4">
        @csrf

        <x-field label="Full name" name="name" required autofocus autocomplete="name" />
        <x-field label="Email address" name="email" type="email" required autocomplete="username" />
        <x-field label="Password" name="password" type="password" required autocomplete="new-password" />
        <x-field label="Confirm password" name="password_confirmation" type="password" required autocomplete="new-password" />

        <button type="submit" class="w-full rounded-full bg-forest py-3.5 text-sm font-bold text-white transition hover:bg-ink">Create my account</button>
    </form>

    <x-auth-social />

    <p class="mt-7 text-center text-sm text-muted">
        Already have an account? <a href="{{ route('login') }}" class="font-bold text-coral">Log in</a>
    </p>
</x-layouts.auth>
