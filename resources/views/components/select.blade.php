 <!-- Book Department (Categories) -->
 <label for="{{ $name }}" class="form-label text-end d-block">@lang('gadwalls.' . $name)</label>
 <select class="form-control {{ $errors->has($error) ? 'is-invalid' : '' }}" id="{{ $name }}"
     name="{{ $name }}">
     <option value="" disabled {{ old($name) ? '' : 'selected' }}>@lang('gadwalls.' . $name)</option>
     @foreach ($select as $item)
         <option value="{{ $item->id }}" {{ old($name, $name->id ?? '') == $item->id ? 'selected' : '' }}
             name="{{ $name }}">
             {{ $item->name }}
         </option>
     @endforeach
 </select>
 @error($error)
     <span class="invalid-feedback d-block text-danger">{{ $message }}</span>
 @enderror
