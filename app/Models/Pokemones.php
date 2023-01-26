<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemones extends Model
{
    use HasFactory;
    
    protected $table = 'pokemones';
    
    protected $fillable = ['nombre', 'atk', 'def', 'hp', 'idObjeto', 'filepath', 'mimetype'];
    
    public $timestamps = false;
    
    public function objetos() {
        return $this -> belongsTo('App\Models\Objetos', "idObjeto");
    }
    
    public function tipopokemon() {
        return $this -> belongsTo('App\Models\TipoPokemon', "idPokemon");
    }
}
