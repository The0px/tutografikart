<div {{ $attributes->class([
    'rounded border px-4 py-3',
    'border-red-400 bg-red-100 text-red-700' => $type === 'danger',
    'border-green-400 bg-green-100 text-green-700' => $type !== 'danger',
]) }}>
    {{ $prefix }}{{ $slot }}
</div>
