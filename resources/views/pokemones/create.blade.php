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
<form action="{{ url('pokemones') }}" method="post" enctype="multipart/form-data">
    @csrf
    <br>
    <input class="form-control" value="{{ old('nombre') }}" type="text" name="nombre" placeholder="Pokemon name" minlength="5" maxlength="150" required />
    @error('nombre')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    <input class="form-control" value="{{ old('atk') }}" type="text" name="atk" placeholder="Pokemon base atk" min="1" max="20" step="1"/>
    @error('atk')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    <input class="form-control" value="{{ old('def') }}" type="text" name="def" placeholder="Pokemon base def" min="1" max="20" step="1"/>
    @error('def')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    <input class="form-control" value="{{ old('hp') }}" type="text" name="hp" placeholder="Pokemon base hp" min="1" max="20" step="1"/>
    @error('def')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    <input type="file" name='pokemonimg' id='pokemonimg' class="form-control" id="customFile" />
    <br>    
    <select name="tipoUno" class="form-control">
        <option disabled value="null"  @if (old('tipoUno') == "")  disabled @endif>Tipo 1</option>
        @foreach ($tipos as $tipo)
            <option value="{{ $tipo->id }}" @if(old('tipoUno') == $tipo->id) selected @endif >{{ $tipo->nombre }}</option>
        @endforeach
    </select>
    
    &nbsp; &nbsp; &nbsp;
    
    <select name="tipoDos" class="form-control">
        <option disabled value="null"  @if (old('tipoDos') == "") disabled @endif>Tipo 2</option>
        @foreach ($tipos as $tipo)
            <option value="{{ $tipo->id }}" @if(old('tipoDos') == $tipo->id) selected @endif >{{ $tipo->nombre }}</option>
        @endforeach
    </select>
    <input style="margin-top:30px; width: 300px !important;" class="btn btn-primary" type="submit" value="Crear"/>
</form>
</div>
@endsection