@extends('base')
@section('title', 'Home')
@section('content')
    <div class="bg-light p-5 mb-5 text-center">
        <div class="container">
            <h1>Agence Immo</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium repellendus explicabo aspernatur at
                quidem quae adipisci autem asperiores consectetur vel vitae nisi, debitis, deleniti in ipsam maiores? Animi,
                earum accusamus!
            </p>
        </div>
    </div>
    <div class="container">
        <h2>Nos derniers biens</h2>
        <div class="row">
            @foreach ($properties as $property)
                <div class="col">
                    @include('property.card')
                </div>
            @endforeach
        </div>
    </div>
@endsection
