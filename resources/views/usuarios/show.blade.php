@extends('../template')
@section('content')

<div style="width:100%; height:auto; padding-right:50px; padding-left:50px; display:flex; flex-wrap: wrap; align-items:center; justify-content:center; ">
    
    
    
<div style="background-color:orange !important;" class="pokemon">
    @foreach($pokemones as $pokemon)
                
                    @if($user->idPokemonFav != null && $pokemon->id == $user->idPokemonFav)
                    
                       <div class="img-container"><img style="width:auto; height:auto; max-width:100px; max-height:100px;" src="{{ asset('storage/images/' . $pokemon->filepath) }}"></img></div>
                        
                    @endif
                    
                @endforeach
  
  <div class="info">
    
    <span class="number">{{ $user->name }}</span>
    <br>
    <br>
                <small class="type"><span>{{ $user->email }}</span></small>
                <br>
                @foreach($pokemones as $pokemon)
                
                    @if($user->idPokemonFav != null && $pokemon->id == $user->idPokemonFav)
                    
                        <small class="type">Pokemon favorito:<span><a style="color:black;" href="{{ url('pokemones/'. $pokemon->id) }}"> &nbsp;{{ $pokemon->nombre }}</a> </span></small>
                        <br>
                        
                    @endif
                    
                @endforeach
            <br>
          <a style="color:black;" href="{{ url('usuarios/'. $user->id .'/edit') }}">Editar Usuario</a>
  </div>
</div>

@if(Auth::user()->rol == 'Profesor Pokemon')
    @foreach($allUsers as $allUser)
        @if($allUser->id != $user->id)
            <div class="pokemon">
            @foreach($pokemones as $pokemon)
                
                    @if($allUser->idPokemonFav != null && $pokemon->id == $allUser->idPokemonFav)
                    
                       <div class="img-container"><img style="width:auto; height:auto; max-width:100px; max-height:100px;" src="{{ asset('storage/images/' . $pokemon->filepath) }}"></img></div>
                        
                    @endif
                    
            @endforeach
  
          <div class="info">
    
            <span class="number">{{ $allUser->name }}</span>
            <br>
            <br>
                <small class="type"><span>{{ $allUser->email }}</span></small>
                <br>
                @foreach($pokemones as $pokemon)
                
                    @if($allUser->idPokemonFav != null && $pokemon->id == $allUser->idPokemonFav)
                    
                        <small class="type">Pokemon favorito:<span><a style="color:black;" href="{{ url('pokemones/'. $pokemon->id) }}"> &nbsp;{{ $pokemon->nombre }}</a> </span></small>
                        <br>
                        
                    @endif
                    
                @endforeach
            <br>
          <a style="color:black;" href="{{ url('usuarios/'. $allUser->id .'/edit') }}">Editar Usuario</a>
        @if(Auth::user()->rol == 'Profesor Pokemon')
          <br>
          <form id="modalDeleteResourceForm" action="{{ url('usuarios/' . $allUser->id) }}" method="post">
                  @method('delete')
                  @csrf
                  <input type="submit" class="btn btn-primary" value="Eliminar Usuario"/>
                </form>
        @endif
        
          </div>
            </div>
        @endif
    @endforeach
@endif

</div>  

@endsection