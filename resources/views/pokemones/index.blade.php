@extends('../template')
@section('content')

<div style="width:100%; height:auto; padding-right:50px; padding-left:50px; display:flex; flex-wrap: wrap; justify-content:flex-start;">
  @if(Session::has('message'))
    <div class="alert alert-{{ session()->get('type') }}" role="alert">
        {{ session()->get('message') }}
    </div>
@endif







<div style="display:flex; flex-direction:column; align-items:center; justify-content:space-evenly;">

<form action="{{ $rutaSearch ?? '' }}" method="get">
          <input value="{{ $appendData['search'] ?? '' }}" name="search" type="text" autocomplete="off">
           @isset($appendData)
            @foreach($appendData as $name => $value)
              @if($name != 'search')
                <input type="hidden" name="{{ $name }}" value="{{ $value }}">
              @endif
            @endforeach
          @endisset
          <button type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M19.023 16.977a35.13 35.13 0 0 1-1.367-1.384c-.372-.378-.596-.653-.596-.653l-2.8-1.337A6.962 6.962 0 0 0 16 9c0-3.859-3.14-7-7-7S2 5.141 2 9s3.14 7 7 7c1.763 0 3.37-.66 4.603-1.739l1.337 2.8s.275.224.653.596c.387.363.896.854 1.384 1.367l1.358 1.392.604.646 2.121-2.121-.646-.604c-.379-.372-.885-.866-1.391-1.36zM9 14c-2.757 0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5z"></path></svg>
          </button>
        </form>
<a href="{{ route('pokemones.index', $ordernameasc) }}">Ordenar Ascendentemente</a>
<a href="{{ route('pokemones.index', $ordernamedesc) }}">Ordenar Descendentemente</a>
</div>

@foreach($pokemones as $pokemon)


<div class="pokemon">
  <div class="img-container"><img style="width:auto; height:auto; max-width:100px; max-height:100px;" src="{{ asset('storage/images/' . $pokemon->filepath) }}"></img></div>
  <div class="info">
    
    <span class="number">{{ $pokemon->id }}</span>
    
      <h3 class="name"><a style="color:black;" href="{{ url('pokemones/'. $pokemon->id) }}">{{ $pokemon->nombre }}</a></h3>
        
        @foreach($tiposPokemones as $tipoPokemon)
        
          @if($tipoPokemon->idPokemon == $pokemon->id)
          
            @foreach($tipos as $tipo)
            
              @if($tipo->id == $tipoPokemon->idTipo)
                <small class="type">Tipo: <span><a style="color:black;" href="{{ url('tipos/'. $tipo->id) }}">{{ $tipo->nombre }}</span></a></small>
                <br>
              @endif
              
            @endforeach
           
          @endif
          
        @endforeach
        
        @if(Auth::user()->rol == 'Profesor Pokemon')
          <br>
          <a style="color:black;" href="{{ url('pokemones/'. $pokemon->id .'/edit') }}">Editar Pokemon</a>
        @endif
          <br>
          <a style="color:black;" href="{{ url('pokemones/'. $pokemon->id) }}">Ver Pokemon</a>
        
  </div>
</div>
@endforeach

<div style="position: absolute; bottom:100px; left:300px;">
  {{ $pokemones->onEachSide(1)->links() }}
</div>
</div>

@endsection