@extends('../template')
@section('content')

@if(Auth::user()->rol == 'Profesor Pokemon')
    @foreach($allUsers as $allUser)
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
          
        
          </div>
            </div>
    @endforeach
@endif
</div>  


@endsection