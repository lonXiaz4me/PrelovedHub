<x-layouts.marketplace title="Settings">
    <x-page-title eyebrow="Your preferences" title="Settings"
                  description="Manage your account, notifications, and marketplace preferences." />

    <div class="mt-8 rounded-card border border-line bg-white p-6 sm:p-8">
        @guest
            <h2 class="font-display text-xl font-semibold">Log in to manage your account</h2>
            <p class="mt-1 text-sm text-muted">Profile details, notifications, and password settings are available once you’re signed in.</p>
            <div class="mt-5 flex flex-wrap gap-3">
                <a href="{{ route('login') }}" class="rounded-full bg-forest px-5 py-2.5 text-sm font-bold text-white transition hover:bg-ink">Log in</a>
                <a href="{{ route('register') }}" class="rounded-full border border-line px-5 py-2.5 text-sm font-bold transition hover:border-forest">Create an account</a>
            </div>
        @else
            <h2 class="font-display text-xl font-semibold">Settings are being built</h2>
            <p class="mt-1 text-sm text-muted">Until then, you can update your name, email, and password on the profile page.</p>
            <a href="{{ route('profile.edit') }}" class="mt-5 inline-flex rounded-full bg-forest px-5 py-2.5 text-sm font-bold text-white transition hover:bg-ink">Open profile</a>
        @endguest
    </div>
</x-layouts.marketplace>
