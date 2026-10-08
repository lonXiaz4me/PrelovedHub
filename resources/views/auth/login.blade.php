<x-layouts.auth title="Log in" eyebrow="Welcome back" heading="Good finds await."
                subheading="Log in to continue buying, selling, and saving.">

    @if (session('status'))
        <p class="mt-6 rounded-xl bg-sage/60 px-4 py-3 text-sm font-semibold text-forest">{{ session('status') }}</p>
    @endif

    <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-4">
        @csrf

        <x-field label="Email address" name="email" type="email" required autofocus autocomplete="username" />
        <x-field label="Password" name="password" type="password" required autocomplete="current-password" />

        <div class="flex items-center justify-between text-xs">
            <label class="flex items-center gap-2 text-muted">
                <input type="checkbox" name="remember" class="rounded border-line text-forest focus:ring-forest/30"> Remember me
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="font-bold text-forest hover:text-coral">Forgot password?</a>
            @endif
        </div>

        <button type="submit" class="w-full rounded-full bg-forest py-3.5 text-sm font-bold text-white transition hover:bg-ink">Log in</button>
    </form>

    <x-auth-social />

    <p class="mt-7 text-center text-sm text-muted">
        New to PrelovedHub? <a href="{{ route('register') }}" class="font-bold text-coral">Sign up</a>
    </p>
</x-layouts.auth>
