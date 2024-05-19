<?php

namespace App\Http\Controllers\api;

use App\Models\conductor;
use \Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class conductoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $conductors = conductor::all();
        return json_encode(['conductors' => $conductors]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'nombre'=> ['required'],
            'apellido'=> ['required'],
            'licencia'=> ['required'],
            'fecha_contratacion'=> ['required'],

        ]);

        if($validate->fails()){
            return response()->json([
                'msg'=> 'Se produjo un error en la validacion de la informacion ',
                'statusCode'=> 400
            ]);
        }
        $conductor = new conductor();
        $conductor->nombre = $request->nombre;
        $conductor->apellido = $request->apellido;
        $conductor->licencia = $request->licencia;
        $conductor->fecha_contratacion = $request->fecha_contratacion;
        $conductor->id = $request->id;
        $conductor->save();
        return json_encode(['conductor' => $conductor,'success'=>true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $conductor = conductor::find($id);
        if (is_null($conductor)){
            return abort(404);
        }
        return json_encode(['conductor' => $conductor]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $conductor = conductor::find($id);
        if (is_null($conductor)){
            return abort(404);
        }
        $validate = Validator::make($request->all(),[
            'nombre'=> ['required'],
            'apellido'=> ['required'],
            'licencia'=> ['required','integer'],
            'fecha_contratacion'=> ['required'],

        ]);

        if($validate->fails()){
            return response()->json([
                'msg'=> 'Se produjo un error en la validacion de la informacion ',
                'statusCode'=> 400
            ]);
        }
        $conductor->nombre = $request->nombre;
        $conductor->apellido = $request->apellido;
        $conductor->licencia = $request->licencia;
        $conductor->fecha_contratacion = $request->fecha_contratacion;
        $conductor->save();
        return json_encode(['conductor' => $conductor,'success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $conductor = conductor::find($id);
        if (is_null($conductor)){
            return abort(404);
        }
        $conductor->delete();
        return json_encode(['conductor' => $conductor,'success'=>true]);
    }
}
