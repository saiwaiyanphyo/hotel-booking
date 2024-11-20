<div class="form-floating">

    <select id="{{ $name }}" class="form-select @error($name) is-invalid @enderror" name="{{ $name }}"
        {{ isset($required) && $required ? 'required' : '' }}>

        <option value="">Select {{ $label }}</option>
        @foreach($options as $option)
        <option value="{{ $option->id }}" @if($option->id==$roomTypeId)
            selected
            @endif>{{ $option->name }}</option>
        @endforeach
    </select>
    <label for="{{ $label }}">{{ $label }}
        @if(isset($required) && $required)
        <span class="text-danger">&nbsp;&lowast;</span>
        @endif
    </label>
</div>
@if ($errors->has($name))
<span class="text-danger small fw-bolder" role="alert">{{ $errors->first($name) }}</span>
@endif