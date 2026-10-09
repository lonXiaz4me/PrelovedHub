{{-- Log in / Sign up buttons shown to guests in the header --}}
<a href="{{ route('login') }}" class="rounded-full bg-forest px-4 py-2 text-xs font-bold text-white sm:hidden">{{ __('Log in') }}</a>
<div class="hidden items-center gap-2 sm:flex">
    <a href="{{ route('login') }}" class="rounded-full px-4 py-2.5 text-sm font-semibold text-brand transition hover:bg-brand/10">{{ __('Log in') }}</a>
    <a href="{{ route('register') }}" class="rounded-full bg-forest px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-forest-dark">{{ __('Sign up') }}</a>
</div>
