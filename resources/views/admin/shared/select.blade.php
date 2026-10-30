@php
$class ??= null;
$name ??= '';
$value ??= '';
$label ??= ucfirst($name);
@endphp

<div @class(['flex min-w-0 flex-col gap-1', $class])>
    <label class="text-sm" for="{{ $name }}">{{ $label }}</label>
    <select name="{{ $name }}[]" id="{{ $name }}" multiple class="min-h-28 w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 @error($name) border-red-500 @enderror">
        @foreach($options as $k => $v)
            <option @selected($value->contains($k)) value="{{ $k }}">{{ $v }}</option>

        @endforeach
    </select>
    @error($name)
        <div class="text-red-500 text-sm">
            {{ $message }}
        </div>
    @enderror
</div>
