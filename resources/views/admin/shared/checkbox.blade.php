@php
$class ??= null;
$name ??= '';
$value ??= false;
$label ??= null;
@endphp
<div @class(['flex flex-col gap-1', $class])>
    <div class="flex items-center gap-2">
        <input type="hidden" value="0" name="{{ $name }}">
        <input @checked(old($name, $value ?? false)) type="checkbox" value="1" name="{{ $name }}" class="peer sr-only" role="switch" id="{{ $name }}">
        <label for="{{ $name }}" class="relative h-5 w-9 shrink-0 cursor-pointer rounded-full bg-gray-300 transition peer-focus-visible:ring-2 peer-focus-visible:ring-blue-400 peer-checked:bg-blue-500 after:absolute after:top-0.5 after:left-0.5 after:h-4 after:w-4 after:rounded-full after:bg-white after:transition after:content-[''] peer-checked:after:translate-x-4 @error($name) ring-2 ring-red-500 @enderror"></label>
        <label class="text-sm" for="{{ $name }}">{{ $label }}</label>
    </div>

    @error($name)
        <div class="text-red-500 text-sm">
            {{ $message }}
        </div>
    @enderror
</div>
