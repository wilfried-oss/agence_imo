@php
    $type ??= 'text';
    $name ??= ' ';
    $label ??= ucfirst($name);
    $class ??= null;
    $value ??= '';
@endphp

<div @class(['form-group', $class])>
    <label for="{{ $name }}">{{ $label }} :</label>
    @if ($type === 'textarea')
        <textarea id="{{ $name }}" name="{{ $name }}" type="{{ $type }}"
            class="@error($name)is-invalid @enderror form-control col">{{ old($name, $value) }} 
        </textarea>
    @else
        <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}"
            class="@error($name)is-invalid @enderror form-control col" value="{{ old($name, $value) }}">
    @endif
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
