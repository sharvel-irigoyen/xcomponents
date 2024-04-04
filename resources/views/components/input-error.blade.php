@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'fs-6 text-red-600']) }}>{{ $message }}</p>
@enderror
