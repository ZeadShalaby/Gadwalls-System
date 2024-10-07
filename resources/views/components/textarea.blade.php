<label for="{{ $name }}" class="form-label text-right d-block">@lang('gadwalls.' . $name)</label>
<textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="{{ $name }}"
    rows="3" placeholder="@lang('gadwalls.' . $name)" name="{{ $name }}">{{ old($name) }}</textarea>
@error($error)
    <span class="invalid-feedback d-block text-danger">{{ $message }}</span>
@enderror
