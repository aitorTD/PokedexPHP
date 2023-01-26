@extends('../template')
@section('content')

<div style="width:100%; height:auto; padding-right:50px; padding-left:50px; display:flex; flex-wrap: wrap; align-items:center; justify-content:center; ">
@if(Session::has('message'))
    <div class="alert alert-{{ session()->get('type') }}" role="alert">
        {{ session()->get('message') }}
    </div>
@endif
@foreach($tiposAll as $tipo)
          <div style="background-color:#73de90 !important;" class="pokemon">
          <div class="info">
    
            <span class="number">{{ $tipo->nombre }}</span>
            <br>
            <br>
            @if(Auth::user()->rol == 'Profesor Pokemon')
                <a style="color:black;" href="{{ url('tipos/'. $tipo->id .'/edit') }}">Editar Tipo</a>
                <br>
                <form id="modalDeleteResourceForm" action="{{ url('tipos/' . $tipo->id) }}" method="post">
            @method('delete')
            @csrf
            <input type="submit" class="btn btn-primary" value="Eliminar tipo"/>
        </form>
            @endif
          </div>
          </div>

  
  @endforeach
@endsection