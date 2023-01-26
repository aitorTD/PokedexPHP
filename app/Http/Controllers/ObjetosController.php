<?php

namespace App\Http\Controllers;

use App\Models\Objetos;
use Illuminate\Http\Request;

class ObjetosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('objetos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('objetos.create');
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
     * @param  \App\Models\Objetos  $objetos
     * @return \Illuminate\Http\Response
     */
    public function show(Objetos $objetos)
    {
        return view('objetos.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Objetos  $objetos
     * @return \Illuminate\Http\Response
     */
    public function edit(Objetos $objetos)
    {
        return view('objetos.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Objetos  $objetos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Objetos $objetos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Objetos  $objetos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Objetos $objetos)
    {
        //
    }
}
