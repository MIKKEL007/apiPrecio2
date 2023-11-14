<?php

namespace App\Http\Controllers;

use App\Models\PrecioModel;
use Illuminate\Http\Request;

class PrecioController extends Controller
{
    public function getPrecios(){
        
        $precios =  PrecioModel::all();

        if ($precios->count() > 0) {
            return response()->json([
                'data' => $precios
            ], 200);
        }else{
            return response()->json([
                'code' => 404,
                'data' => "no hay registros"
            ], 404);
        }
    }
}

