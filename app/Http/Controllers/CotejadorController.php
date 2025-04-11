<?php

namespace App\Http\Controllers;

use App\Models\Admin\Region;
use Illuminate\Http\Request;
use App\Models\Admin\Teacher;
use App\Models\Admin\Delegation;
use App\Models\Cotejador\Cotejador;
use App\Models\User;

class CotejadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $regiones = Region::withCount('delegations')->get();

        $delegaciones = Delegation::all();
        return view('cotejador.index',compact('user','regiones','delegaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {   
        $region = Region::find($id);
        $delegaciones = Delegation::with('users')
            ->where('id_region', $id)
            ->orderBy('delegacion')
            ->get();
        // return $delegaciones; 

        // info($delegaciones);
        return view('cotejador.show', compact('region','delegaciones'));
    }

    public function showListadoTeachers($id)
    {
        $srio = User::where('id', $id)->first();
        // return response()->json($srio);

        $listadoTeachers = Teacher::where('id_user', $id)
                          ->orderBy('nombre', 'asc') // ordena por la columna 'nombre' de forma ascendente
                          ->get();
        // return response()->json($listadoTeachers);
        return view('cotejador.listado-teachers', compact('listadoTeachers','srio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cotejador $cotejador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cotejador $cotejador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cotejador $cotejador)
    {
        //
    }
}
