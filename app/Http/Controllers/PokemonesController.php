<?php

namespace App\Http\Controllers;

use DB;
use App\Models\TipoPokemon;
use App\Models\User;
use App\Models\Pokemones;
// use App\Http\Controllers\TiposController;
use App\Models\Tipos;
use Illuminate\Http\Request;

class PokemonesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    private function verifySort($sort) {
        if($sort == null) {
            return $sort;
        } else if($sort == 'id') {
            return $sort;
        } else if($sort == 'nombre') {
            return $sort;
        }
        return null;
    }
    
    private function verifyOrder($order) {
        if($order == null) {
            return $order;
        } else if($order == 'desc') {
            return $order;
        } else {
            return 'asc';
        }
    }
     
     
     
    public function index(Request $request)
    {
            
        $search = $request->input('search');
        $data = [];
        
        $pokemon = new Pokemones();
        $sort = $this->verifySort($request->input('sort'));
        $order = $this->verifyOrder($request->input('order'));
        $sortData = [];
        $appendData = [];
        $searchData = [];
        
        if($search != null) {
            $pokemon = $pokemon->where('nombre', 'like', '%' . $search . '%')->orWhere('nombre', 'like', '%' . $search . '%');
        }
        
        if($sort != null && $order != null) {
            $pokemon = $pokemon->orderBy($sort, $order);
            $sortData = [
                'sort' => $sort,
                'order' => $order,
            ];
        }
        
        if($search != null) {
            $searchData['search'] = $search;
        }
        
        $data['ordernameasc'] = ['sort' => 'nombre', 'order' => 'asc', 'search' => $search];
        $data['ordernamedesc'] = ['sort' => 'nombre', 'order' => 'desc', 'search' => $search];
        $appendData = array_merge($appendData, $sortData);
        $appendData = array_merge($appendData, $searchData);

        $data['appendData'] = $appendData;
        
        $pokemones = $pokemon->orderBy('id', 'asc')->paginate(2)->appends($appendData);
        return view('pokemones.index', ['pokemones' => $pokemones, 'tiposPokemones' => TipoPokemon::all(), 'tipos' => Tipos::all()])->with($data);
        
        
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        $data['tipos'] = Tipos::all();
        return view('pokemones.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $data = [];
        $data['message'] = 'A new Pokemon has been added succesfully';
        $data['type'] = 'success';
        $pokemones = new Pokemones($request->all());
        
        if($request->hasFile('pokemonimg')){
            $file = $request->file('pokemonimg');
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('public/images/',$filename);
            //  $mimetype = $request->file->getMimeType();
            $pokemones->filepath = $filename;
            $pokemones->mimetype = $file->getMimeType();
        }
        
        try {
            $result = $pokemones->save();
        } catch(\Exception $e) {
            DB::rollBack();
            $data['message'] = 'The Pokemon hasn`t been added';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);
        }
        
        
        
        // GUARDAMOS LOS TIPOS DE PKM
        $tipos = new TipoPokemon();
        $tipos->idTipo = $request->input('tipoUno');
        $tipos->idPokemon = $pokemones->id;
        try {
            $result = $tipos->save();
           
        } catch(\Exception $e) {
            DB::rollBack();
            $data['message'] = 'The Pokemon hasn`t been added';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);
        }
        
        $tiposDos = new TipoPokemon();
        $tiposDos->idTipo = $request->input('tipoDos');
        $tiposDos->idPokemon = $pokemones->id;
        try {
            $result = $tiposDos->save();
           
        } catch(\Exception $e) {
            DB::rollBack();
            $data['message'] = 'The Pokemon hasn`t been added';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);
        }
        DB::commit();
        return back()->withInput()->with($data);
 }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pokemones  $pokemones
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];
        $pokemon = Pokemones::find($id);
        $data['pokemon'] = $pokemon;
        $data['tiposPokemones'] = TipoPokemon::all();
        $data['tipos'] = Tipos::all();
        return view('pokemones.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pokemones  $pokemones
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pokemones = Pokemones::find($id);
        $data = [];
        $data['pokemones'] = $pokemones;
        $data['tiposPokemones'] = TipoPokemon::all();
        $data['tipos'] = Tipos::all();
        return view('pokemones.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pokemones  $pokemones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $data = [];
        $data['message'] = 'Se ha editado el pokemon correctamente';
        $data['type'] = 'success';
        
        $pokemones = Pokemones::find($id);
        try {
            
            $tiposPokemones = TipoPokemon::where('idPokemon', $id)->get();
            $tiposPokemones[0]->update(array('idTipo'=> $request->tipoUno));
            if(isset($request->tipoDos)) {
                $tiposPokemones[1]->update(array('idTipo'=> $request->tipoDos));
            }
            else {
                $tiposPokemones[1]->update(array('idTipo'=>null));
            }
        
            $pokemones->update( $request->all());
        } catch(\Exception $e) {
            DB::rollBack();
            $data['message'] = 'No se ha podido editar el pokemon';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);
        }
        DB::commit();
        return back()->withInput()->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pokemones  $pokemones
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        $data = [];
        $pokemon = Pokemones::find($id);
        $data['message'] = 'El pokemon ' . $pokemon->nombre . ' ha sido eliminado.';
        $data['type'] = 'success';
        
        try{
            $usersPkmFav = User::where('idPokemonFav', $id)->get();
                if(isset($usersPkmFav)) {
                    foreach($usersPkmFav as $userPkmFav) {
                    $userPkmFav->update(array('idPokemonFav'=>null));
                }
            }
        } catch(\Exception $e) {
            DB::rollBack();
        }
        
        try {
            $tiposPokemones = TipoPokemon::where('idPokemon', $id)->get();
            
            if(isset($tiposPokemones) && $tiposPokemones != null) {
                $tiposPokemones[0]->delete();
                $tiposPokemones[1]->delete();
            }
          
        } catch(\Exception $e) {
            DB::rollBack();
        }
        
    
        try {
            $pokemon->delete();
        } catch(\Exception $e) {
            DB::rollBack();
            $data['message'] = 'El pokemon ' . $pokemon->nombre . ' no ha sido ha sido eliminado.';
            $data['type'] = 'danger';
        }
        DB::commit();
        return redirect('pokemones')->with($data);
        
    }
}
