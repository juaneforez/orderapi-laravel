<?php

namespace App\Http\Controllers;

use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class TechnicianController extends Controller
{
    private $rules = [
        'document' => 'required|integer|max:99999999999999999999|min:3',
        'name' => 'required|string|max:80|min:3',
        'especiality' => 'string|max:50|min:2',
        'phone' => 'string|max:30|min:4',
    ];
    private $traductionAttributes = [
        'document' => 'documento',
        'name' => 'nombre',
        'especiality' => 'especialidad',
        'phone' => 'telefono',
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
        $technician = Technician::all();
        return response()->json($technician, Response::HTTP_OK);
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

        $technician = Technician::create($request->all());
        $response = [
            'message' => 'Registro creado exitosamente',
            'technician' => $technician
        ];
        return response()->json($response, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Technician $technician)
    {
        return response()->json($technician, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technician $technician)
    {
        $data = $this->applyValidator($request);
        if(!empty($data))
        {
            return $data;
        }

        $technician->update($request->all());
        $response = [
            'message' => 'Registro actualizado exitosamente',
            'technician' => $technician
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technician $technician)
    {
        $technician->delete();
        $response = [
            'message' => 'Registro eliminado exitosamente',
            'technician' => $technician->id
        ];
        return response()->json($response, Response::HTTP_OK);

    }
}
