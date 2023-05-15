@extends('base')
@section('title', 'Se connecter')
@section('content')
    <div class="mt-4 p-5  container">
        <h1>@yield('title')</h1>
        <form action="{{ route('login_perform') }}" method="post" class="vstack gap-3">
            @include('shared.flash')
            @csrf
            @include('shared.input', [
                'label' => 'Email',
                'name' => 'email',
            ])
            @include('shared.input', [
                'label' => 'Mot de passe',
                'type' => 'password',
                'name' => 'password',
            ])
            <div>
                <button class="btn btn-primary">
                    Se connecter
                </button>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            setTimeout(function() {
                $('.flash-message').fadeOut('fast');
            }, 3000);
        });
    </script>
@endsection
