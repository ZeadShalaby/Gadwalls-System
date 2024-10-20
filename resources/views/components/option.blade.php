<label for="{{ $name }}" class="form-label text-end d-block">@lang('gadwalls.' . $name)</label>
<select class="form-control {{ $errors->has($error) ? 'is-invalid' : '' }}" id="{{ $id }}"
    name="{{ $name }}">
    <option value="" disabled {{ old($name) ? '' : 'selected' }}>@lang('gadwalls.' . $name)</option>
    @if (isset($options) && !empty($options))
        @foreach ($options as $option)
            <!-- Assuming $options are passed to the component -->
            <option value="{{ $option->id }}" {{ old($name) == $option->id ? 'selected' : '' }}>{{ $option->name }}
            </option>
        @endforeach
    @endif
</select>
@error($error)
    <span class="invalid-feedback d-block text-danger">{{ $message }}</span>
@enderror
