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
<form action="{{ url('pokemones/'. $pokemones->id) }}" method="post">
        @csrf
    @method('put')
    <br>
    <input class="form-control" value="{{ $pokemones->nombre }}" type="text" name="nombre" placeholder="{{ $pokemones->nombre }}" minlength="5" maxlength="150" required />
    @error('nombre')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    <input class="form-control" value="{{ $pokemones->atk }}" type="text" name="atk" placeholder="{{ $pokemones->atk }}" min="1" max="20" step="1"/>
    @error('atk')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    <input class="form-control" value="{{ $pokemones->def }}" type="text" name="def" placeholder="{{ $pokemones->def }}" min="1" max="20" step="1"/>
    @error('def')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    <input class="form-control" value="{{ $pokemones->hp }}" type="text" name="hp" placeholder="{{ $pokemones->hp }}" min="1" max="20" step="1"/>
    @error('def')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    
    <select name="tipoUno" class="form-control">
        <option value=""  @if (old('tipoUno') == "") selected @endif>&nbsp;</option>
        @foreach ($tipos as $tipo)
            <option value="{{ $tipo->id }}" @if(old('tipoUno') == $tipo->id) selected @endif >{{ $tipo->nombre }}</option>
        @endforeach
    </select>
    
    &nbsp; &nbsp; &nbsp;
    
    <select name="tipoDos" class="form-control">
        <option value=""  @if (old('tipoDos') == "") selected @endif>&nbsp;</option>
        @foreach ($tipos as $tipo)
            <option value="{{ $tipo->id }}" @if(old('tipoDos') == $tipo->id) selected @endif >{{ $tipo->nombre }}</option>
        @endforeach
    </select>
    <input style="margin-top:30px; width: 300px !important;" class="btn btn-primary" type="submit" value="Editar"/>
</form>
</div>
@endsection