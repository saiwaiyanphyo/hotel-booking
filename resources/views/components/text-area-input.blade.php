<div class="form-floating" >
    <textarea id="{{ $name }}"
              class="form-control @error($name) is-invalid @enderror"
              name="{{ $name }}"
              autocomplete="off"
              maxlength="250"
              placeholder="{{ $label }}"
              {{ isset($required) && $required ? 'required' : '' }}>{{ old($name, $value) }}</textarea>
    <label for="{{ $label }}">{{ $label }}
        @if(isset($required) && $required)
            <span class="text-danger">&nbsp;&lowast;</span>
        @endif
    </label>
</div>