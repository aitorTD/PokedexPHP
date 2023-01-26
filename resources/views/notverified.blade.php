@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if
            
            @endif
            <div class="card">
                <div class="card-header">Verify your e-mail</div>
                <div class="card-body">
                        <div class="alert alert-success" role="alert">
                           Check your inbox mail or 
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another verification email.') }}</button>.
                    </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
