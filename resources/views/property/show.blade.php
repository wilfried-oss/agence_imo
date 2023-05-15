@extends('base')
@section('title', $property->title)
@section('content')
    <div class="container mt-4">
        <div class="card-group">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">{{ mb_strtoupper($property->title) }}</h5>
                    <h5>Description</h5>
                    <p class="card-text">{{ $property->description }}</p>
                    <p class="card-text">
                        <small class="text-muted">
                            Last Update {{ $property->updated_at->diffForHumans() }}
                        </small>
                    </p>
                </div>
            </div>
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">{{ mb_strtoupper($property->title) }}</h5>
                    <h5>Prix</h5>
                    <p class="card-text fs-5 fw-bold text-primary">
                        {{ number_format($property->price, 0, ' ', ' ') }} €
                    </p>
                    <p class="card-text">
                        <small class="text-muted">
                            Last Update {{ $property->updated_at->diffForHumans() }}
                        </small>
                    </p>
                </div>
            </div>
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">{{ mb_strtoupper($property->title) }}</h5>
                    <p class="card-text">
                        Surface : {{ $property->surface }} m²
                    </p>

                    <p class="card-text">
                        Chambres: {{ $property->rooms }}
                    </p>
                    <p class="card-text">
                        <small class="text-muted">
                            Last Update {{ $property->updated_at->diffForHumans() }}
                        </small>
                    </p>
                </div>
            </div>
        </div>
        <hr>
        <div class="container my-4">
            <div id="property-images" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach ($property->images as $key => $image)
                        <button type="button" data-bs-target="#property-images" data-bs-slide-to="{{ $key }}"
                            class="@if ($loop->first) active @endif" aria-current="true"
                            aria-label="Slide {{ $key + 1 }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach ($property->images as $key => $image)
                        <div class="carousel-item @if ($loop->first) active @endif">
                            <img src="{{ Storage::url($image->url) }}" class="d-block w-100" alt="logo">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#property-images" data-bs-slide="prev">
                    <span style="font-size: 6rem; width: 6em; height: 6rem" class="carousel-control-prev-icon"
                        aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#property-images" data-bs-slide="next">
                    <span style="font-size: 6rem; width: 6em; height: 6rem"class="carousel-control-next-icon"
                        aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        {{-- <div class="slider">
            @foreach ($property->images as $image)
                <div><img style="max-width: 50%; height: auto;" src="{{ Storage::url($image->url) }}" alt="logo">
                </div>
            @endforeach
        </div> --}}
        <hr>
        <div class="mt-4">
            <h4>Intéressé par ce bien ?</h4>
            <form action="{{ route('property.contact', $property) }}" method="post" class="vstack gap-3">
                @csrf
                <div class="row">
                    @include('shared.input', [
                        'class' => 'col',
                        'name' => 'firstname',
                        'label' => 'Prénom',
                        'value' => 'John',
                    ])
                    @include('shared.input', [
                        'class' => 'col',
                        'name' => 'lastname',
                        'label' => 'Nom',
                        'value' => 'Does',
                    ])
                </div>
                <div class="row">
                    @include('shared.input', [
                        'class' => 'col',
                        'name' => 'phone',
                        'label' => 'Téléphone',
                        'value' => '06 44 55 77',
                    ])
                    @include('shared.input', [
                        'class' => 'col',
                        'name' => 'email',
                        'label' => 'Email',
                        'type' => 'email',
                        'value' => 'john.doe@gmail.com',
                    ])
                </div>

                @include('shared.input', [
                    // 'class' => 'ml-0',
                    'label' => 'Votre message',
                    'name' => 'message',
                    'type' => 'textarea',
                    'value' => 'Mon petit message',
                ])
                <div>
                    <button class="btn btn-primary">Nous contacter</button>
                </div>
                <div class="mt-4">
                    <p>{{ nl2br($property->description) }}</p>
                    <div class="row">
                        <div class="col-8">
                            <h2>Caractéristiques</h2>
                            <table class="table table-striped">
                                <tr>
                                    <td>Surface habitable</td>
                                    <td>{{ $property->surface }} m²</td>
                                </tr>
                                <tr>
                                    <td>Pièces</td>
                                    <td>{{ $property->rooms }} </td>
                                </tr>
                                <tr>
                                    <td>Chambres</td>
                                    <td>{{ $property->bedrooms }}</td>
                                </tr>
                                <tr>
                                    <td>Etages</td>
                                    <td>{{ $property->floor ?: 'Rez de chaussé' }}</td>
                                </tr>
                                <tr>
                                    <td>Localisation</td>
                                    <td>
                                        {{ $property->address }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Code Postal</td>
                                    <td>
                                        {{ $property->postal_code }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ville</td>
                                    <td>{{ $property->city }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-4">
                            <h2>Spécificités</h2>
                            <ul class="list-group">
                                @foreach ($property->options as $option)
                                    <li class="list-group-item">{{ $option->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.slider').slick({
                dots: true,
                infinite: true,
                speed: 500,
                fade: true,
                cssEase: 'linear'
            });
        });
    </script>
@endsection
