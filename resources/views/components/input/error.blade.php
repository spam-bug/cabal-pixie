@props(['for'])

@error($for)
    <small {{ $attributes->class(['text-red-500']) }}>{{ $message }}</small>
@enderror