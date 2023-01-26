@extends('../template')
@section('content')


<div class="modal" id="modalDelete" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar?</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
        <p>Desea eliminar a <span id="eliminarPokemon"></span>?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <form id="modalDeleteResourceForm" action="{{ url('pokemones/' . $pokemon->id) }}" method="post">
            @method('delete')
            @csrf
            <input type="submit" class="btn btn-primary" value="Eliminar pokemon"/>
        </form>
      </div>
    </div>
  </div>
</div>


<div style="width:100%; height:auto; padding-right:50px; padding-left:50px; display:flex; flex-wrap: wrap; align-items:center; justify-content:center;">

<div class="pokemon">
  <div style="background-image: url(''); background-repeat:no-repeat;" class="img-container"> <img style="width:auto; height:auto; max-width:100px; max-height:100px;" src="{{ asset('storage/images/' . $pokemon->filepath) }}"></img> </div>
  <div class="info">
    
    <span class="number">{{ $pokemon->id }}</span>
    
      <h3 class="name">{{ $pokemon->nombre }}</h3>
        
        @foreach($tiposPokemones as $tipoPokemon)
        
          @if($tipoPokemon->idPokemon == $pokemon->id)
          
            @foreach($tipos as $tipo)
            
              @if($tipo->id == $tipoPokemon->idTipo)
                <small class="type">Tipo: <span><a style="color:black;" href="{{ url('tipos/'. $tipo->id) }}"> {{ $tipo->nombre }}</span></a></small>
                <br>
              @endif
              
            @endforeach
           
          @endif
          
        @endforeach
        <br>
        <small class="type">Ataque base: <span>{{ $pokemon->atk }}</span></small>
        <br>
        <small class="type">Defensa base: <span>{{ $pokemon->def }}</span></small>
        <br>
        <small class="type">Vida base: <span>{{ $pokemon->hp }}</span></small>
        <br>
        
        @if(Auth::user()->rol == 'Profesor Pokemon')
          <br>
          <form id="modalDeleteResourceForm" action="{{ url('pokemones/' . $pokemon->id) }}" method="post">
            @method('delete')
            @csrf
            <input type="submit" class="btn btn-primary" value="Eliminar pokemon"/>
        </form>
        @endif
        
  </div>
</div>


</div>  

@endsection
@section('js')
<script type="text/javascript" src="{{ url('assets/js/deletePokemon.js') }}"></script>
@endsection