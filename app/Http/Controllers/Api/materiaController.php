<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Materia; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MateriaController extends Controller
{
    public function index()
    {
        // Recupera todas las materias desde la base de datos
        $materia = Materia::all();

        $data = [
            'materia' => $materia,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255', 
            'language' => 'required|in:C,PHP,Python,Java,Go,JavaScript'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $materia = Materia::create([
            'name' => $request->name,
            'language' => $request->language
        ]);

        if (!$materia) {
            $data = [
                'message' => 'Error al crear el estudiante',
                'status' => 500 
            ];
            return response()->json($data, 500);
        }

        $data = [
            'materia' => $materia,
            'status' => 201
        ];
        return response()->json($data, 201);
    }
    public function show($id)
    {
        $materia = materia::find($id);
        if (!$materia) {
            $data = [
                'message' => 'Materia no encontrada',
                'status'=> 404            ];
                return response() ->json($data, 404);
        }
        $data = [
            'materia' => $materia,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
    public function destroy($id)
    {
        $materia = materia::find($id);

        if (!$materia) {
            $data = [
                'message' => 'Materia no encontrada',
                'status'=> 404            ];
                return response() ->json($data, 404);
        }

        $materia -> delete();

        $data = [
            'message' => 'Estudiante eliminado',
            'status' => 200
        ];
       
    }
    public function update(Request $request, $id)
    {
        $materia = materia::find($id);

        if (!$materia) {
            $data = [
                'message' => 'Materia no encontrada',
                'status'=> 404            ];
                return response() ->json($data, 404);
        }
        
     
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
        'language' => 'required|in:C,PHP,Python,Java,Go,JavaScript' 
    ]);
    if ($validator->fails()) {
        $data = [
            'message' => 'Error en la validación de los datos',
            'errors' => $validator->errors(),
            'status' => 400
        ];
        return response()->json($data, 400);
    }
    $materia->name = $request->name;
    $materia->language = $request->language;

    $materia ->save();

    $data = [
        'materia'=> $materia,
        'status' => 200,
        'message' => "Estudiante actualizado!"
    ];
    return response()->json($data, 200);
}

public function updatesParcial(Request $request, $id) {
    $materia = materia::find($id);
    if (!$materia) {
        $data = [
            'message' => 'Materia no encontrada',
            'status'=> 404            ];
            return response() ->json($request->all(), 200);
    }
    $validator = Validator::make($request->all(), [
        'name' => 'max:255',
        'language' => 'in:C,PHP,Python,Java,Go,JavaScript' 
    ]);
    if ($validator->fails()) {
        $data = [
            'message' => 'Error en la validación de los datos',
            'errors' => $validator->errors(),
            'status' => 400
        ];
        return response()->json($data, 400);
    }
    if ($request->has('name')) {
        $materia->name = $request->name;
    }
    if ($request->has('language')) {
        $materia->language = $request->language;
    }
    $materia->save();
    $data = [
        'materia'=> $materia,
        'status' => 200,
        'message' => "Estudiante actualizado!"
    ];
    return response()->json($data, 200);
}
}