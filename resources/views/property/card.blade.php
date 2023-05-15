<div class="card">
    @if ($property->images->isNotEmpty())
        <img src="{{ Storage::url($property->images->first()->url) }}" class="card-img-top" alt="Pas d'image(s)">
    @endif

    <div class="card-body text-center">
        <h5 class="card-title">
            <a href="{{ route('property.show', $property) }}">
                {{ $property->title }}
            </a>
        </h5>
        <p class="card-text mt-3">
            {{ $property->surface }} m² - {{ $property->city }} ({{ $property->postal_code }})
        </p>
        <div class="text-primary fw-bold" style="font-size: 1.4rem">
            {{ number_format($property->price, 0, ' ', ' ') }} €
        </div>
    </div>
</div>
