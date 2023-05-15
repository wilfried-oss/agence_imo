@extends('admin.base')
@section('title', $property->exists ? 'Editer un bien ' : 'Créer un bien')
@section('content')
    <h1>@yield('title')</h1>
    <form class="vstack gap-2"
        action="{{ route($property->exists ? 'admin.property.update' : 'admin.property.store', ['property' => $property]) }}"
        method="post" enctype="multipart/form-data">
        @csrf
        @method($property->exists ? 'PUT' : 'POST')
        <div class="row">
            @include('shared.input', [
                'class' => 'col',
                'label' => 'Titre',
                'name' => 'title',
                'value' => $property->title,
            ])
            <div class="row col">
                @include('shared.input', [
                    'class' => 'col',
                    'name' => 'surface',
                    'value' => $property->surface,
                ])
                @include('shared.input', [
                    'class' => 'col',
                    'label' => 'Prix',
                    'name' => 'price',
                    'value' => $property->price,
                ])
            </div>
        </div>
        @include('shared.input', [
            'class' => 'ml-0',
            'name' => 'description',
            'type' => 'textarea',
            'value' => $property->description,
        ])

        <div class="row">
            @include('shared.input', [
                'class' => 'col',
                'name' => 'rooms',
                'label' => 'Pièces',
                'value' => $property->rooms,
            ])
            @include('shared.input', [
                'class' => 'col',
                'name' => 'bedrooms',
                'label' => 'Chambres',
                'value' => $property->bedrooms,
            ])

            @include('shared.input', [
                'class' => 'col',
                'name' => 'floor',
                'label' => 'Etages',
                'value' => $property->floor,
            ])
        </div>
        <div class="row">
            @include('shared.input', [
                'class' => 'col',
                'name' => 'address',
                'label' => 'Adresse',
                'value' => $property->address,
            ])

            @include('shared.input', [
                'class' => 'col',
                'name' => 'city',
                'label' => 'Ville',
                'value' => $property->city,
            ])

            @include('shared.input', [
                'class' => 'col',
                'name' => 'postal_code',
                'label' => 'Code postal',
                'value' => $property->postal_code,
            ])
        </div>
        @include('shared.select', [
            'name' => 'options',
            'label' => 'Options',
            'options' => $options,
            'value' => $property->options()->pluck('id'),
        ])
        <div>
            <label for="images">Images :</label>
            <input class="@error('images') is-invalid @enderror form-control col" type="file" name="images[]"
                id="images" multiple>
            {{-- @if ($errors->has('images'))
                <div class="alert alert-danger">{{ $errors->first('images') }}</div>
            @endif --}}
            @error('images')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        @include('shared.checkbox', [
            'name' => 'sold',
            'label' => 'Vendu',
            'value' => $property->sold,
        ])
        <div>
            <button class="btn btn-primary" type="submit">
                @if ($property->exists)
                    Modifier
                @else
                    Créer
                @endif
            </button>
        </div>
    </form>
@endsection
@section('script')
    <script>
        new TomSelect('select[multiple]', {
            plugins: {
                remove_button: {
                    title: 'Supprimé'
                }
            }
        });
    </script>
@endsection
