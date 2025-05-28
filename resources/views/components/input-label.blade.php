@props(['value'])

<label {{ $attributes->merge(['class' => 'form-label my-0']) }}>
    {{ $value ?? $slot }}
</label>
