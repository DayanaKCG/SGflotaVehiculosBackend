<?php

namespace App\Http\Controllers\api;

use App\Models\ruta;
use \Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class rutasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rutas = ruta::all();
        return json_encode(['rutas' => $rutas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'descripcion'=> ['required'],
            'origen'=> ['required'],
            'destino'=> ['required'],
            'distancia'=> ['required'],

        ]);

        if($validate->fails()){
            return response()->json([
                'msg'=> 'Se produjo un error en la validacion de la informacion ',
                'statusCode'=> 400
            ]);
        }
        $ruta = new ruta();
        $ruta->descripcion = $request->descripcion;
        $ruta->origen = $request->origen;
        $ruta->destino = $request->destino;
        $ruta->distancia = $request->distancia;
        $ruta->id = $request->id;
        $ruta->save();
        return json_encode(['ruta' => $ruta,'success'=>true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ruta = ruta::find($id);
        if (is_null($ruta)){
            return abort(404);
        }
        return json_encode(['ruta' => $ruta]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ruta = ruta::find($id);
        if (is_null($ruta)){
            return abort(404);
        }
        $validate = Validator::make($request->all(),[
            'descripcion'=> ['required'],
            'origen'=> ['required'],
            'destino'=> ['required'],
            'distancia'=> ['required'],

        ]);

        if($validate->fails()){
            return response()->json([
                'msg'=> 'Se produjo un error en la validacion de la informacion ',
                'statusCode'=> 400
            ]);
        }
        $ruta->descripcion = $request->descripcion;
        $ruta->origen = $request->origen;
        $ruta->destino = $request->destino;
        $ruta->distancia = $request->distancia;
        $ruta->save();
        return json_encode(['ruta' => $ruta,'success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ruta = ruta::find($id);
        if (is_null($ruta)){
            return abort(404);
        }
        $ruta->delete();
        return json_encode(['ruta' => $ruta,'success'=>true]);
    }
}
