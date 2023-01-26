<!DOCTYPE html>
<html lang="en" style="width:100%; height:100%;">
<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="{{ url('assets/css/style.css') }}" />
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <style>
    .w-5, .h-5 {
      display:none !important;
    }
    
    .flex {
      display:flex !important;
      flex-direction:column !important;
      border:1px solid red !important;
      align-items:center !important;
      justify-content:space-evenly !important;
    }
  </style>
  
  <title>Pokedex</title>
</head>
<body>
  
<nav style="width:100%; height:70px; margin-bottom:50px; display:flex; justify-content:space-evenly; align-items:center;">
  @if(Auth::user()->rol == 'Profesor Pokemon')
    <a href="{{ url('pokemones/create') }}">Crear Pokemon</a>
  @endif
  <a href="{{ url('usuarios/'.auth()->user()->id) }}">{{ auth()->user()->name }}</a>
  <a href="{{ url('pokemones') }}"><h1>Pokedex</h1></a> 
  @if(Auth::user()->rol == 'Profesor Pokemon')
    <a href="{{ url('tipos/create') }}">Crear Tipos</a>
  @endif
  <a href="{{ route('logout') }}" onclick="event.preventDefault();
  document.getElementById('logout-form').submit();">Logout</a>
</nav>
      
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
  @csrf
</form>


@yield('content')


@yield('js')
</body>
</html>