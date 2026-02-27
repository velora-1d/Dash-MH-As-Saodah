{{-- Komponen select-input: dropdown yang estetik --}}
@props([
    'disabled' => false
])

<select @disabled($disabled) {{ $attributes->merge(['class' => 'fi-input fi-select']) }}>
    {{ $slot }}
</select>
