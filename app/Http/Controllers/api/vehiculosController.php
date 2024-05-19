<?php

namespace App\Http\Controllers\api;

use App\Models\vehiculo;
use \Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class vehiculosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehiculos = vehiculo::all();
        return json_encode(['vehiculos' => $vehiculos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'matricula'=> ['required'],
            'marca'=> ['required'],
            'ano'=> ['required'],
            'estado'=> ['required'],

        ]);

        if($validate->fails()){
            return response()->json([
                'msg'=> 'Se produjo un error en la validacion de la informacion ',
                'statusCode'=> 400
            ]);
        }
        $vehiculo = new vehiculo();
        $vehiculo->matricula = $request->matricula;
        $vehiculo->marca = $request->marca;
        $vehiculo->ano = $request->ano;
        $vehiculo->estado = $request->estado;
        $vehiculo->id = $request->id;
        $vehiculo->save();
        return json_encode(['vehiculo' => $vehiculo,'success'=>true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vehiculo = vehiculo::find($id);
        if (is_null($vehiculo)){
            return abort(404);
        }
        return json_encode(['vehiculo' => $vehiculo]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vehiculo = vehiculo::find($id);
        if (is_null($vehiculo)){
            return abort(404);
        }
        $validate = Validator::make($request->all(),[
            'matricula'=> ['required'],
            'marca'=> ['required'],
            'ano'=> ['required'],
            'estado'=> ['required'],

        ]);

        if($validate->fails()){
            return response()->json([
                'msg'=> 'Se produjo un error en la validacion de la informacion ',
                'statusCode'=> 400
            ]);
        }
        $vehiculo->matricula = $request->matricula;
        $vehiculo->marca = $request->marca;
        $vehiculo->ano = $request->ano;
        $vehiculo->estado = $request->estado;
        $vehiculo->save();
        return json_encode(['vehiculo' => $vehiculo,'success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vehiculo = vehiculo::find($id);
        if (is_null($vehiculo)){
            return abort(404);
        }
        $vehiculo->delete();
        return json_encode(['vehiculo' => $vehiculo,'success'=>true]);
    }
}
