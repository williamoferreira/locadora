<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;


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
        return response()->json($marcas, 200);
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
     * @note Adicionar ao header do request o parametro
     *      accept: application/json 
     * para que o serivdor entenda que o cliente não 
     * espera redirecis no processamento de erros
     */
    public function store(Request $request)
    {
        
        try {
            $regras = [
                'nome' => 'required|unique:marcas',
                'imagem' => 'required'
            ];
            $feedback = [
                'required' => 'O campo :attribute é obrigatório',
                'nome.unique' => 'O nome da marca já existe'
            ];
            $mensagem = $request->validate($regras, $feedback);
            $marca = $this->marca->create($request->all());        
            return response()->json($marca, 201);
        } catch (ValidationException $e) {
            return response()->json(
                ['erro' => $mensagem], 422
            );
        }
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
            return $response()->json($marca,200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404);
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
        return $response()->json($marca, 200);
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
            return $response()->json(['msg' => "A marca foi removida com sucesso!"], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'NOT FOUND'], 404);
        }
    }
}
