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
<form action="{{ url('tipos') }}" method="post" enctype="multipart/form-data">
    @csrf
    <br>
    <input class="form-control" value="{{ old('nombre') }}" type="text" name="nombre" placeholder="Type name" minlength="3" maxlength="150" required />
    @error('nombre')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <input style="margin-top:30px; width: 300px !important;" class="btn btn-primary" type="submit" value="Crear"/>
</form>
</div>
@endsection