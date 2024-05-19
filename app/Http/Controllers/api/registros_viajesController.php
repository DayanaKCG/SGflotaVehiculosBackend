<?php

namespace App\Http\Controllers\api;

use App\Models\registros_viaje;
use \Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class registros_viajesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registros_viajes = DB::table('registros_viajes')
            ->join('vehiculos', 'registros_viajes.vehiculo_id', '=', 'vehiculos.id')
            ->join('conductores', 'registros_viajes.conductor_id', '=', 'conductores.id')
            ->join('rutas', 'registros_viajes.ruta_id', '=', 'rutas.id')
            ->select('registros_viajes.*', 'vehiculos.matricula as matricula','conductores.nombre as nombre','rutas.descripcion as descripcion')
            ->get();
            return json_encode(['registros_viajes' => $registros_viajes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'vehiculo_id'=> ['required','integer'],
            'conductor_id'=> ['required','integer'],
            'ruta_id'=> ['required','integer'],
            'fecha_inicio'=> ['required'],
            'fecha_fin'=> ['required'],
            'kilometraje'=> ['required'],

        ]);

        if($validate->fails()){
            return response()->json([
                'msg'=> 'Se produjo un error en la validacion de la informacion ',
                'statusCode'=> 400
            ]);
        }
        $registros_viaje = new registros_viaje();
        $registros_viaje->vehiculo_id = $request->vehiculo_id;
        $registros_viaje->conductor_id = $request->conductor_id;
        $registros_viaje->ruta_id = $request->ruta_id;
        $registros_viaje->fecha_inicio = $request->fecha_inicio;
        $registros_viaje->fecha_fin = $request->fecha_fin;
        $registros_viaje->kilometraje = $request->kilometraje;
        $registros_viaje->id = $request->id;
        $registros_viaje->save();
        return json_encode(['registros_viaje' => $registros_viaje,'success'=>true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $registros_viaje = registros_viaje::find($id);
        if (is_null($registros_viaje)){
            return abort(404);
        }

        $vehiculos = DB::table('vehiculos')
            ->orderBy('matricula')
            ->get();
        $conductores = DB::table('conductores')
            ->orderBy('nombre')
            ->get();
        $rutas = DB::table('rutas')
            ->orderBy('descripcion')
            ->get();
        return json_encode(['registros_viaje' => $registros_viaje,"vehiculos" => $vehiculos,"rutas" => $rutas,"conductores" => $conductores]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $registros_viaje = registros_viaje::find($id);
        if (is_null($registros_viaje)){
            return abort(404);
        }
        $validate = Validator::make($request->all(),[
            'vehiculo_id'=> ['required','integer'],
            'conductor_id'=> ['required','integer'],
            'ruta_id'=> ['required','integer'],
            'fecha_inicio'=> ['required'],
            'fecha_fin'=> ['required'],
            'kilometraje'=> ['required'],

        ]);

        if($validate->fails()){
            return response()->json([
                'msg'=> 'Se produjo un error en la validacion de la informacion ',
                'statusCode'=> 400
            ]);
        }

        $registros_viaje->vehiculo_id = $request->vehiculo_id;
        $registros_viaje->conductor_id = $request->conductor_id;
        $registros_viaje->ruta_id = $request->ruta_id;
        $registros_viaje->fecha_inicio = $request->fecha_inicio;
        $registros_viaje->fecha_fin = $request->fecha_fin;
        $registros_viaje->kilometraje = $request->kilometraje;
        $registros_viaje->save();
        return json_encode(['registros_viaje' => $registros_viaje,'success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $registros_viaje = registros_viaje::find($id);
        if (is_null($registros_viaje)){
            return abort(404);
        }
        $registros_viaje->delete();
        return json_encode(['registros_viaje' => $registros_viaje,'success'=>true]);
    }
}
