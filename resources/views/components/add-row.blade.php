@if ($name != 'code')
    <label for="{{ $name }}" class="form-label text-end d-block">@lang('gadwalls.' . $name)</label>
@endif
<input type="{{ $type }}" class="form-control {{ $errors->has($error) ? 'is-invalid' : '' }}" id="author_name"
    placeholder="@lang('gadwalls.' . $name)" name="{{ $name }}" value="{{ old($name) }}">
@error('{{ $name }}')
    <span class="invalid-feedback d-block text-danger">{{ $message }}</span>
@enderror
