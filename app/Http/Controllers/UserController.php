<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use App\Models\Pokemones;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['allUsers'] = User::all();
        $data['pokemones'] = Pokemones::all();
        return view('usuarios.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $data = [];
        $data['user'] = $user;
        $data['allUsers'] = User::all();
        $data['pokemones'] = Pokemones::all();
        return view('usuarios.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $data = [];
        $data['user'] = $user;
        $data['pokemones'] = Pokemones::all();
        return view('usuarios.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $user = User::find($id);
        $data = [];
        $data['message'] = 'Se ha editado el usuario correctamente';
        $data['type'] = 'success';
        $request->password = Hash::make($request->password);
        $dataUser = $request->all();
        $dataUser['password'] = Hash::make($request->input('password'));
        
        try {
            $result = $user->update($dataUser);
        } catch(\Exception $e) {
            DB::rollBack();
            $data['message'] = 'No se ha podido editar el usuario';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);
        }
        DB::commit();
        return back()->withInput()->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        $data = [];
        $user = User::find($id);
        $data['message'] = 'El usuario ' . $user->name . ' ha sido eliminado.';
        $data['type'] = 'success';
        
        try {
            $user->delete();
        } catch(\Exception $e) {
          DB::rollBack();
            $data['message'] = 'El usuario ' . $user->name . ' no ha sido ha sido eliminado.';
            $data['type'] = 'danger';
        }
        DB::commit();
        return redirect('pokemones')->with($data);
    }
}
