<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $regiones = Region::pluck('region')->toArray();
        $regiones = Region::all();
        return view('admin.regions.index',compact('regiones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.regions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','string'],
            'sede' => ['required','string'],
        ]);

        Region::create([
            'region' => $request->input('name'),
            'sede' => $request->input('sede'),
        ]);

        return redirect()->route('region.index')->with('success_region','Registro guardado');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $region = Region::find($id);
        return view('admin.regions.edit',compact('region'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required','string'],
            'sede' => ['required','string'],
        ]);
        
        $region = Region::find($id);        
        $region->region = $request->input('name');
        $region->sede = $request->input('sede');

        $region->save();

        return redirect()->route('region.index')->with('update_region','Registro actualizado');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Region::destroy($id);
        return redirect()->route('region.index')->with('destroy_region','Región eliminada');
    }
}
