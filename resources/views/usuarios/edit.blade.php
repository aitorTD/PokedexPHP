@extends('../template')
@section('content')
<div style="width:100%; height:15px; display:flex; justify-content:center; align-items:center; margin-top:100px;">
@if(Session::has('message'))
    <div class="alert alert-{{ session()->get('type') }}" role="alert">
        {{ session()->get('message') }}
    </div>
@endif
</div>
<div style="width:100%; height:100%; display:flex; justify-content:center; align-items:center;">
<form action="{{ url('usuarios/'. $user->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <br>
    <input class="form-control" value="{{ $user->name }}" type="text" name="name" placeholder="New name" minlength="4" maxlength="150" required />
    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    <input class="form-control" value="{{ $user->email }}" type="text" name="email" placeholder="new e-mail" min="1" max="20" step="1" required />
    @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    <input class="form-control" type="password" name="password" placeholder="new password" min="1" max="20" step="1"/>
    @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    Pokemon favorito:
    <br>
    <select name="idPokemonFav" id="idPokemonFav" class="form-control">
        
        @foreach ($pokemones as $pokemon)
            @if($pokemon->id == $user->idPokemonFav)
                <option value="{{ $pokemon->id }}"  @if ($pokemon->id == $user->idPokemonFav) disabled selected @endif>{{ $pokemon->nombre }}</option>
            @endif
        @endforeach
        
        
        @foreach ($pokemones as $pokemon)
            @if($pokemon->id != $user->idPokemonFav)
            
                <option value="{{ $pokemon->id }}" @if(old('pokemon') == $pokemon->id) selected @endif >{{ $pokemon->nombre }}</option>
            
            @endif
        @endforeach
        
    </select>
    
    <input style="margin-top:30px; width: 300px !important;" class="btn btn-primary" type="submit" value="Editar"/>
</form>
</div>
@endsection