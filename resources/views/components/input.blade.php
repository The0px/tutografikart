@php
$type ??= 'text';
$class ??= null;
$name ??= '';
$value ??= '';
$label ??= ucfirst($name);
@endphp

<div @class(['flex min-w-0 flex-col gap-1', $class])>
    <label class="text-sm" for="{{ $name }}">{{ $label }}</label>
    @if($type === 'textarea')
        <textarea class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 @error($name) border-red-500 @enderror" id="{{ $name }}" name="{{ $name }}" rows="3">{{ old($name, $value) }}</textarea>
    @else
        <input class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 @error($name) border-red-500 @enderror" type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}">
    @endif
    @error($name)
        <div class="text-red-500 text-sm">
            {{ $message }}
        </div>
    @enderror
</div>
