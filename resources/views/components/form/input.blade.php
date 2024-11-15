@props([
    'label' => false,
    'type' => 'text',
    'name',
    'value' => '',
])
@if ($label)
    <label for="">{{ $label }}</label>
@endif
<input
    {{ $attributes->class([
        'form-control',
        'is-invalid' => $errors->has($name),
    ]) }}
type="{{ $type }}" name="{{ $name }}" value="{{ $value }}">
@error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror