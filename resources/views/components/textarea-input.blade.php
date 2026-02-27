{{-- Komponen textarea-input: textarea yang estetik --}}
@props([
    'disabled' => false
])

<textarea @disabled($disabled) {{ $attributes->merge(['class' => 'fi-input fi-textarea']) }}>{{ $slot }}</textarea>
