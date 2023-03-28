<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
class BaseController extends Controller
{
    protected $model = 'dataHeader';
    public function ResponseOk($codigo,  $errores)
    {
        $dataHeader = [
            'codRespuesta' => $codigo,
            'errores' => $errores
        ];
        return $dataHeader;
    }


}
