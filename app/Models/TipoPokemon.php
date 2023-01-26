<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPokemon extends Model
{
    use HasFactory;
    
    protected $table = 'tipo_pokemon';
    
    protected $fillable = ['id', 'idTipo', 'idPokemon'];
    
    public function pokemones() {
        return $this -> hasMany('App\Models\Pokemones', "idPokemon");
    }
    
    public function tipos() {
        return $this -> hasMany('App\Models\Tipos', "idTipo");
    }
}
