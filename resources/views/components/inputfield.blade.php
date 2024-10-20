<div class="form-group">
    <label for="{{ $name }}" class="form-label text-right d-block">@lang('gadwalls.' . $name)</label>
    <input type="{{ $type }}" class="form-control w-100 {{ $errors->has($error) ? 'is-invalid' : '' }}"
        @error($error) style="border: 2px solid red" @enderror id="{{ $name }}" placeholder="@lang('gadwalls.' . $placeholder)"
        id="{{ $name }}" placeholder="@lang('gadwalls.' . $name)" name="{{ $name }}" value="{{ old($name) }}">
    @error($error)
        <span class="invalid-feedback d-block text-danger">{{ $message }}</span>
    @enderror

</div>
