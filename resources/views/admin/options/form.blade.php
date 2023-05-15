@extends('admin.base')
@section('title', $option->exists ? 'Editer une option ' : 'Créer une option')
@section('content')
    <h1>@yield('title')</h1>
    <form class="vstack gap-2"
        action="{{ route($option->exists ? 'admin.option.update' : 'admin.option.store', ['option' => $option]) }}"
        method="post">
        @csrf
        @method($option->exists ? 'PUT' : 'POST')
        <div class="row col">
            @include('shared.input', [
                'label' => 'Nom',
                'name' => 'name',
                'type' => 'text',
                'value' => $option->name,
            ])
        </div>
        <div>
            <button class="btn btn-primary" type="submit">
                @if ($option->exists)
                    Modifier
                @else
                    Créer
                @endif
            </button>
        </div>
    </form>
@endsection
