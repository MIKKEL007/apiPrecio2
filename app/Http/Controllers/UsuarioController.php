<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function getUsers(){
        
        $usuarios =  Usuario::all();

        if ($usuarios->count() > 0) {
            return response()->json([
                'code' => 200,
                'data' => $usuarios
            ], 200);
        }else{
            return response()->json([
                'code' => 404,
                'data' => "no hay registros"
            ], 404);
        }
    }
}

