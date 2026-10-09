@props(['label', 'name', 'type' => 'text', 'value' => null])

@php
    $isPassword = $type === 'password';
    $classes = 'h-11 w-full rounded-xl border bg-canvas px-3 text-sm outline-none transition focus:border-brand focus:ring-4 focus:ring-brand/10 '
        . ($errors->has($name) ? 'border-coral' : 'border-line')
        . ($isPassword ? ' pr-11 [&::-ms-reveal]:hidden' : '');
@endphp

<div @if ($isPassword) x-data="{ show: false }" @endif>
    <label for="{{ $name }}" class="text-xs font-bold text-muted">{{ $label }}</label>

    <div class="relative mt-2">
        <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}"
               @if ($isPassword) :type="show ? 'text' : 'password'" @else value="{{ old($name, $value) }}" @endif
               {{ $attributes->merge(['class' => $classes]) }}>

        @if ($isPassword)
            {{-- Show / hide password (eye icon inside the right side of the box) --}}
            <button type="button" @click="show = !show"
                    :aria-label="show ? @js(__('Hide password')) : @js(__('Show password'))"
                    :aria-pressed="show"
                    class="absolute right-1.5 top-1/2 flex size-8 -translate-y-1/2 items-center justify-center rounded-full text-muted transition hover:text-brand">
                <x-icon name="eye" x-show="!show" class="size-5" />
                <x-icon name="eye-off" x-show="show" x-cloak class="size-5" />
            </button>
        @endif
    </div>

    @error($name)
        <p class="mt-1.5 text-xs font-semibold text-coral-dark">{{ $message }}</p>
    @enderror
</div>
