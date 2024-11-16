@props(['name', 'options', 'checked' => '' ])

@foreach ($options as $key => $value )
    <div class="form-check">
        <input
        {{ $attributes->class([
            'form-check-input',
            'is-invalid' => $errors->has($name),
        ]) }}
         type="radio" name="{{ $name }}" id="{{ $key }}" value="{{ $key }}" @checked( old($name, $checked) == $key )>
        <label class="form-check-label" for="{{ $key }}">{{ $value }}</label>
        @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div> 
@endforeach