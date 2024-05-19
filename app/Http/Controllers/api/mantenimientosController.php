<?php

namespace App\Http\Controllers\api;

use App\Models\mantenimiento;
use \Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class mantenimientosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mantenimientos = DB::table('mantenimientos')
            ->join('vehiculos', 'mantenimientos.vehiculo_id', '=', 'vehiculos.id')
            ->select('mantenimientos.*', 'vehiculos.matricula as matricula')
            ->get();
            return json_encode(['mantenimientos' => $mantenimientos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'vehiculo_id'=> ['required','integer'],
            'fecha'=> ['required'],
            'descripcion'=> ['required'],
            'costo'=> ['required','integer'],

        ]);

        if($validate->fails()){
            return response()->json([
                'msg'=> 'Se produjo un error en la validacion de la informacion ',
                'statusCode'=> 400
            ]);
        }
        $mantenimiento = new mantenimiento();
        $mantenimiento->vehiculo_id = $request->vehiculo_id;
        $mantenimiento->fecha = $request->fecha;
        $mantenimiento->descripcion = $request->descripcion;
        $mantenimiento->costo = $request->costo;
        $mantenimiento->id = $request->id;
        $mantenimiento->save();
        return json_encode(['mantenimiento' => $mantenimiento,'success'=>true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mantenimiento = mantenimiento::find($id);
        if (is_null($mantenimiento)){
            return abort(404);
        }

        $vehiculos = DB::table('vehiculos')
            ->orderBy('matricula')
            ->get();
        return json_encode(['mantenimiento' => $mantenimiento,"vehiculos" => $vehiculos]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mantenimiento = mantenimiento::find($id);
        if (is_null($mantenimiento)){
            return abort(404);
        }
        $validate = Validator::make($request->all(),[
            'vehiculo_id'=> ['required','integer'],
            'fecha'=> ['required'],
            'descripcion'=> ['required'],
            'costo'=> ['required','integer'],

        ]);

        if($validate->fails()){
            return response()->json([
                'msg'=> 'Se produjo un error en la validacion de la informacion ',
                'statusCode'=> 400
            ]);
        }
        $mantenimiento->vehiculo_id = $request->vehiculo_id;
        $mantenimiento->fecha = $request->fecha;
        $mantenimiento->descripcion = $request->descripcion;
        $mantenimiento->costo = $request->costo;
        $mantenimiento->save();
        return json_encode(['mantenimiento' => $mantenimiento,'success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mantenimiento = mantenimiento::find($id);
        if (is_null($mantenimiento)){
            return abort(404);
        }
        $mantenimiento->delete();
        return json_encode(['mantenimiento' => $mantenimiento,'success'=>true]);
    }
}
