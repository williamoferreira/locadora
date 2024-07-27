<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MarcaController extends Controller
{

    public function __construct(Marca $marca) {
        $this->marca = $marca;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $marcas = $this->marca->all();
        return $marcas;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $marca = $this->marca->create($request->all());        
        return $marca;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {

            $marca = $this->marca->findOrFail($id);
            return $marca;
        } catch (ModelNotFoundException $e) {
            return response()->json(['erro' => 'NOT FOUND'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
        // print_r($request->all());
        // echo("<br>");
        $marca = $this->marca->findOrFail($id);
        // print_r($marca->getAttributes());

        $marca->update($request->all());
        return $marca;
        } catch (ModelNotFoundException $e) {
            return response()->json(['erro' => 'NOT FOUND'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $marca = $this->marca->findOrFail($id);
            $marca->delete();
            return ['msg' => "A marca foi removida com sucesso!"];
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'NOT FOUND'], 404);
        }
    }
}
