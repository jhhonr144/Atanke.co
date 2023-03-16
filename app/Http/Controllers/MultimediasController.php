<?php

namespace App\Http\Controllers;

use App\Models\Datos;
use App\Models\Multimedias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MultimediasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $permiso = false;
        $user = $request->user();
        if ($user->elRol->nombre === 'admin') {
            $permiso = true;
        } else
        if ($user->elPermiso->contains('nombre', 'crear_multimedia')) {
            $permiso = true;
        }
        $datos = new Datos();
        if ($permiso) {
            $validator = Validator::make($request->all(), [
                'contenido' => 'file|image|mimes:jpeg,png,jpg|max:2048',
            ]);
            if ($validator->fails()) {
                $datos->id = -1;
                $datos->mensaje = "Error al Guardar Multimedia\n";
                return response()->json($datos);
            } else {
                $para='Contenido';
                if(isset($request->para))
                $para=$request->para; 
                $image = $request->file('contenido');
                $imageName = $user->id . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/img/'.$para, $imageName, ['visibility' => 'public']);                               
                
                $multimedias=new Multimedias();
                $multimedias->descripcion='';
                $multimedias->multimedia=$imageName;
                $multimedias->fk_user=$user->id;
                $multimedias->fk_tm =1;
                $multimedias->save();
                $datos->id = $multimedias->id;
                $datos->mensaje = $imageName ;
            }
        }
        else{
            $datos->id = -1;
            $datos->mensaje = "Error al Guardar Multimedia, No tiene permiso\n";
            return response()->json($datos);
        } 
        return response()->json($datos);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Multimedias  $multimedias
     * @return \Illuminate\Http\Response
     */
    public function show(Multimedias $multimedias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Multimedias  $multimedias
     * @return \Illuminate\Http\Response
     */
    public function edit(Multimedias $multimedias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Multimedias  $multimedias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Multimedias $multimedias)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Multimedias  $multimedias
     * @return \Illuminate\Http\Response
     */
    public function destroy(Multimedias $multimedias)
    {
        //
    }
}
