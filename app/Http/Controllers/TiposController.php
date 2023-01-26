<?php

namespace App\Http\Controllers;

use DB;
use App\Models\TipoPokemon;
use App\Models\Pokemones;
use App\Models\Tipos;
use Illuminate\Http\Request;

class TiposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $tiposAll = Tipos::all();
        $data['tiposAll'] = $tiposAll;
        return view('tipos.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipos.create');
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
        $data['message'] = 'A new type has been added succesfully';
        $data['type'] = 'success';
        $tipos = new Tipos($request->all());
        
        
        try {
            $result = $tipos->save();
        } catch(\Exception $e) {
            DB::rollBack();
            $data['message'] = 'The type hasn`t been added';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);
        }
        DB::commit();
        return back()->withInput()->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tipos  $tipos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tiposAll = Tipos::all();
        $tipos = Tipos::find($id);
        $data['tipos'] = $tipos;
        $data['tiposAll'] = $tiposAll;
        return view('tipos.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tipos  $tipos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipos = Tipos::find($id);
        $data = [];
        $data['tipos'] = $tipos;
        return view('tipos.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tipos  $tipos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $tipos = Tipos::find($id);
        $data = [];
        $data['message'] = 'Se ha editado el tipo correctamente';
        $data['type'] = 'success';
        $tiposNew = $request->all();
        
        try {
            $result = $tipos->update($tiposNew);
        } catch(\Exception $e) {
            DB::rollBack();
            $data['message'] = 'No se ha podido editar el tipo';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);
        }
        DB::commit();
        return back()->withInput()->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tipos  $tipos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = [];
        $tipo = Tipos::find($id);
        $data['message'] = 'El tipo ' . $tipo->nombre . ' ha sido eliminado.';
        $data['type'] = 'success';
        
        try{
            $tiposPokemones = TipoPokemon::where('idTipo', $id)->get();
            $tiposPokemones[0]->delete();
            $tiposPokemones[1]->delete();
        } catch(\Exception $e) {
            
        }
        
    
        try {
            $tipo->delete();
        } catch(\Exception $e) {
            $data['message'] = 'El tipo ' . $tipo->nombre . ' no ha sido ha sido eliminado.';
            $data['type'] = 'danger';
        }
        return redirect('tipos')->with($data);
    }
}
