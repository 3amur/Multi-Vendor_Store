@props([
    'label' => false,
    'name',
    'value' => '',
])
@if ($label)
    <label for="">{{ $label }}</label>
@endif
<textarea
    {{ $attributes->class([
        'form-control',
        'is-invalid' => $errors->has($name),
    ]) }}
    name="{{ $name }}">{{ $value }}</textarea>
@error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror