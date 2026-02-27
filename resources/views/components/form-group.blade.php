{{-- Komponen form-group: membungkus label + input + error --}}
@props([
    'label' => null,
    'name' => null,
    'required' => false,
    'hint' => null,
    'class' => ''
])

<div class="fi-group {{ $class }}">
    @if ($label)
        <label class="fi-label" @if($name) for="{{ $name }}" @endif>
            {{ $label }}
            @if ($required)<span class="fi-required">*</span>@endif
        </label>
    @endif

    {{ $slot }}

    @if ($name)
        @error($name)
            <div class="fi-error-msg">
                <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                {{ $message }}
            </div>
        @enderror
    @endif

    @if ($hint)
        <p class="fi-hint">{{ $hint }}</p>
    @endif
</div>
