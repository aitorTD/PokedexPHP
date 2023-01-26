@extends('../template')
@section('content')

<div style="width:100%; height:auto; padding-right:50px; padding-left:50px; display:flex; flex-wrap: wrap; align-items:center; justify-content:center; ">
    
    
    
<div style="background-color:pink !important;" class="pokemon">
  <div class="info">
    
    <span class="number">{{ $tipos->nombre }}</span>
    <br>
    <br>
          
        @if(Auth::user()->rol == 'Profesor Pokemon')
            <a style="color:black;" href="{{ url('tipos/'. $tipos->id .'/edit') }}">Editar Tipo</a>
          <br>
          <form id="modalDeleteResourceForm" action="{{ url('tipos/' . $tipos->id) }}" method="post">
            @method('delete')
            @csrf
            <input type="submit" class="btn btn-primary" value="Eliminar tipo"/>
        </form>
        @endif
        
  </div>
</div>

@foreach($tiposAll as $tipo)
      @if($tipo->id != $tipos->id)
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

      @endif
  
  @endforeach
@endsection