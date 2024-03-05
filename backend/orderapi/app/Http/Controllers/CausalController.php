<?php

namespace App\Http\Controllers;

use App\Models\Causal;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CausalController extends Controller
{
    private $rules = [
        'description' => 'required|string|max:50|min:3',
    ];
    private $traductionAttributes = [
        'description' => 'descripcion',
    ];

    public function applyValidator(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);
        $validator->setAttributeNames($this->traductionAttributes);
        $data = [];
        if ($validator->fails()) 
        {
            $data = response()->json([
                'errors' => $validator->errors(),
                'data'=> $request->all()
            ], Response::HTTP_BAD_REQUEST);
        }

        return $data;
    }    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $causals = Causal::all();
        return response()->json($causals, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->applyValidator($request);
        if(!empty($data))
        {
            return $data;
        }

        $causal = Causal::create($request->all());
        $response = [
            'message' => 'Registro creado exitosamente',
            'causal' => $causal
        ];
        return response()->json($response, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Causal $causal)
    {
        return response()->json($causal, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Causal $causal)
    {
        $data = $this->applyValidator($request);
        if(!empty($data))
        {
            return $data;
        }

        $causal->update($request->all());
        $response = [
            'message' => 'Registro actualizado exitosamente',
            'causal' => $causal
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Causal $causal)
    {
        $causal->delete();
        $response = [
            'message' => 'Registro eliminado exitosamente',
            'causal' => $causal->id
        ];
        return response()->json($response, Response::HTTP_OK);

    }
}
