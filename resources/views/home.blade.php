@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <br>
                    <br>
                    @if(!Auth::user()->hasVerifiedEmail() )
                        <form action="{{ url('email/resend') }}" method="post">
                            @csrf
                            <input type="submit" value="Enviar correo de verificación"/>
                        </form>
                    @endif
                </div>
            </div>
            <ul>
            <!--PARA COMPROBAR SI ERES GUEST-->
            @if(Auth::guest())
                eres guest
            @endif
            <br>
            <!--PARA COMPROBAR SI ESTÁS LOGUEADO-->
            @if(Auth::user()) 
                eres usuario logueado
            @endif
            <br>
            <!--PARA COMPROBAR SI ESTÁS VERIFICADO-->
            @if(Auth::user()!= null && Auth::user()->hasVerifiedEmail()) 
                eres usuario verificado
            @endif
            <br>
            <!--PARA COMPROBAR SI ERES ROOT-->
            @if(Auth::user()->email == 'atrillo2111@ieszaidinvergeles.org')
                eres usuario root
            @endif
            </ul>
        </div>
    </div>
</div>
@endsection
