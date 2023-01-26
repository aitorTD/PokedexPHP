<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipos extends Model
{
    use HasFactory;
    
    protected $table = 'tipos';
    
    protected $fillable = ['id', 'nombre'];
    
    public function tipopokemon() {
        return $this -> belongsTo('App\Models\TipoPokemon', "idTipo");
    }
}
