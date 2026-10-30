<div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-300">
    <div class="flex-auto p-5">
        <h5 class="mb-4 text-xl font-semibold text-gray-900">
            <a href="{{ route('property.show', [$property->getSlug(), 'property' => $property]) }}">{{ $property->title }}</a>
        </h5>
        <p class="my-0 mb-4 text-gray-700">
            {{ $property->surface }} m² - {{ $property->city }} ({{ $property->postal_code }})
        </p>
        <div class="text-[1.4rem] font-bold text-gray-900">
            {{ number_format($property->price, thousands_separator: ' ') }} €
        </div>
    </div>
</div>
