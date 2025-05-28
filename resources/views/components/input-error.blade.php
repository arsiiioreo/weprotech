@props(['messages'])

@if ($messages)
<div {{ $attributes->merge(['class' => 'd-block my-0']) }}>
    @foreach ((array) $messages as $message)
        <small>{{ $message }}</small>
    @endforeach
</div>
@endif
