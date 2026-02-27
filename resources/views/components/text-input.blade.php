{{-- Komponen text-input: input teks modern --}}
@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'fi-input' . ($errors->has($attributes->get('name', '')) ? ' fi-error' : '')]) }}>
