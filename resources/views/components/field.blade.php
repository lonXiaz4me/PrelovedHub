@props(['label', 'name', 'type' => 'text', 'value' => null])

<div>
    <label for="{{ $name }}" class="text-xs font-bold text-muted">{{ $label }}</label>
    <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}"
           @if ($type !== 'password') value="{{ old($name, $value) }}" @endif
           {{ $attributes->merge(['class' => 'mt-2 h-11 w-full rounded-xl border bg-canvas px-3 text-sm outline-none transition focus:border-brand focus:ring-4 focus:ring-brand/10 ' . ($errors->has($name) ? 'border-coral' : 'border-line')]) }}>
    @error($name)
        <p class="mt-1.5 text-xs font-semibold text-coral-dark">{{ $message }}</p>
    @enderror
</div>
