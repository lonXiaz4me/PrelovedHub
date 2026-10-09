<x-layouts.auth :title="__('Reset password')" :eyebrow="__('Reset password')" :heading="__('Choose a new password.')"
                :subheading="__('Pick something strong that you haven’t used elsewhere.')">

    <form method="POST" action="{{ route('password.store') }}" class="mt-8 space-y-4">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <x-field :label="__('Email address')" name="email" type="email" :value="$request->email" required autofocus autocomplete="username" />
        <x-field :label="__('New password')" name="password" type="password" required autocomplete="new-password" />
        <x-field :label="__('Confirm new password')" name="password_confirmation" type="password" required autocomplete="new-password" />

        <button type="submit" class="w-full rounded-full bg-forest py-3.5 text-sm font-bold text-white transition hover:bg-forest-dark">{{ __('Reset password') }}</button>
    </form>
</x-layouts.auth>
