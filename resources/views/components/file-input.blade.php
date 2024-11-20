<div class="form-floating">
    <input type="file" id="{{ $name }}"
           class="form-control custom-file-input @error($name) is-invalid @enderror"
           name="{{ $name }}{{ isset($multiple) && $multiple ? '[]' : '' }}"
           accept="image/*" {{ isset($required) && $required ? 'required' : '' }} {{ isset($multiple) && $multiple ? 'multiple' : ''}}>
    <label for="{{ $name }}">{{ ucfirst($label) }}
        @if(isset($required) && $required)
            <span class="text-danger">&nbsp;&lowast;</span>
        @endif
    </label>
</div>
@if ($errors->has($name))
    <span class="text-danger small fw-bolder"
          role="alert">{{ $errors->first($name) }}</span>
@endif