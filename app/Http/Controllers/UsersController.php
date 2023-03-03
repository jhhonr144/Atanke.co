<?php

namespace App\Http\Controllers;

use App\Models\Datos;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function listarP(Request $req)
    {
        $pagina = $req->has('pagina') ? $req->pagina : 1;
        $cantidad = $req->has('cantidad') ? $req->cantidad : 3;
        $dato = $req->has('dato') ? $req->dato : null;
        $query = User::query();
        if (!empty($dato)) {
            $query->where('name', 'like', '%' . $dato . '%')
            ->orWhere('email', 'like', '%' . $dato . '%');
        }
        $User = $query->paginate($cantidad, ['*'], 'page', $pagina);

        $datos = new Datos();
        try {
            $datos->id = $User->lastPage();
            $datos->mensaje = "Listado de User #{$pagina}";
            $datos->datos = $User->items();
            $datos->datos_len = $User->total();
        } catch (\Exception $e) {
            $datos->id = -1;
            $datos->mensaje = "Error al listar User\n" . $e;
        }
        return response()->json($datos);
    }



    public function show(User $role)
    {
        $User = User::find($role->id);
        $datos = new Datos();
        try {
            $datos->id = 0;
            $datos->mensaje = "User #" . $role->id;
            $datos->datos = $User->permisos;
            $datos->datos_len = 1;
        } catch (\Exception $e) {
            $datos->id = 1;
            $datos->mensaje = "Error al buscar Rol {$role}\n" . $e;
        }
        return response()->json(($datos));
    }
}
