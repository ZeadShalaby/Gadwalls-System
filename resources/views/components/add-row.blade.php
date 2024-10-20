@if ($name != 'code')
    <label for="{{ $name }}" class="form-label text-start d-block">@lang('gadwalls.' . $name)</label>
@endif
<input type="{{ $type }}" class="form-control {{ $errors->has($error) ? 'is-invalid' : '' }}"
    id="{{ $name }}" placeholder="@lang('gadwalls.' . $name)" name="{{ $name }}" value="{{ old($name) }}">
@error($error)
    <span class="invalid-feedback d-block text-danger">{{ $message }}</span>
@enderror
