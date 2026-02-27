{{-- Komponen money-input: input nominal dengan prefix Rp & auto-format ribuan --}}
@props([
    'disabled' => false,
    'prefix' => 'Rp',
    'name' => '',
    'value' => ''
])

<div class="fi-money-wrap">
    <span class="fi-money-prefix">{{ $prefix }}</span>
    <input type="text" inputmode="numeric"
        @disabled($disabled)
        {{ $attributes->merge([
            'class' => 'fi-input fi-money-input',
            'name' => $name,
            'autocomplete' => 'off'
        ]) }}
        data-money-input
        @if($value) data-raw-value="{{ $value }}" @endif
    >
    {{-- Hidden field untuk kirim nilai asli (tanpa titik) --}}
    @if($name)
        <input type="hidden" name="{{ $name }}" value="{{ $value }}" data-money-raw>
    @endif
</div>
