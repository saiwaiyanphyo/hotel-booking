<div class="form-floating">
    <input type="number" id="{{ $name }}"
           class="form-control @error($name) is-invalid @enderror" name="{{ $name }}"
           autocomplete="off"
           value="{{ old($name, $value) }}"
           step="{{ isset($step) && $step ? '0.01' : '1' }}"
           placeholder="{{ $label }}" {{ isset($required) && $required ? 'required' : '' }}>
    <label for="{{ $label }}">{{ $label }}
        @if(isset($required) && $required)
            <span class="text-danger">&nbsp;&lowast;</span>
        @endif
    </label>
</div>
@if ($errors->has($name))
    <span class="text-danger small fw-bolder"
          role="alert">{{ $errors->first($name) }}</span>
@endif