<?php

namespace App\Http\Controllers;
 
use App\Models\TipoPokemon;
use App\Models\Pokemones;
// use App\Http\Controllers\TiposController;
use App\Models\Tipos;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
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
}
