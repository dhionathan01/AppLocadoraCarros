<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Repositories\ClienteRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repositories\CarroRepository;

class ClienteController extends Controller
{
    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clienteRepository = new clienteRepository($this->cliente);
        if($request->has('filtro')){
            $clienteRepository->filtro($request->filtro);
        }
        if($request->has('atributos')){
            $clienteRepository->selectAtributos($request->atributos);
        }

        return response()->json($clienteRepository->getResultado(), 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClienteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->cliente->rules());
        $cliente = $this->cliente->create(['nome'=> $request->nome]);

        return response()->json($cliente, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = $this->cliente->find($id);
        if($cliente === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404);
        }
        return response()->json($cliente, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClienteRequest  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cliente = $this->cliente->find($id);
        if($cliente === null){
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }
        if($request->method() === 'PATCH'){
            $regrasDinamicas = array();
            // Percorrendo todas as regras definidas no model
            foreach($cliente->rules() as $input => $regra){
                // Coletar apenas as regras aplicáveis  aos parametros parcias da requisição
                if(array_key_exists($input, $request->all())){
                    $regrasDinamicas[$input] = $regra;
                }
            }
            $request->validate($regrasDinamicas);
        }else{
            $request->validate($cliente->rules());
        }
        //preencher o objeto $cliente com os dados do request
        $cliente->fill($request->all());
        $cliente->save();
        return response()->json($cliente, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente= $this->cliente->find($id);
        if($cliente === null){
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404) ;
        }
        // Remove o arquivo caso ele exista
        $cliente->delete();
        return response()->json(['msg' => 'O cliente foi removida com sucesso'], 200);
    }
}
