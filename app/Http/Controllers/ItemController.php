<?php

namespace App\Http\Controllers;


use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ItemController extends Controller
{
    public function getItems(){
        
        $item =  Item::all();

       // return $item;
        if ($item->count() > 0) {
            foreach ($item as $i){

                // $i['detalles'] = json_decode($i['detalles']);
                $i->detalles = json_decode($i->detalles, true);

            }
            return response()->json([
                'data' => $item
            ], 200);
        }else{
            return response()->json([
                'code' => 404,
                'data' => "no hay registros"
            ], 404);
        }
    }

    // public function getItems(){
        
    //     $item =  Item::all();

    //    // return $item;
    //     if ($item->count() > 0) {
    //         foreach ($item as $i){

    //             // $i['detalles'] = json_decode($i['detalles']);
    //             $i->detalles = json_decode($i->detalles, true);

    //         }
    //         return response()->json([
    //             'data' => $item
    //         ], 200);
    //     }else{
    //         return response()->json([
    //             'code' => 404,
    //             'data' => "no hay registros"
    //         ], 404);
    //     }
    // }

    public function createItem(Request $request){
        
        try {
            
            $validacion = Validator::make($request->all(), [
                'nombre' => 'required',
                'precio' => 'required',
                'detalles' => 'required',
                'fk_proyecto' => 'required'
                ]);
            if($validacion->fails()){
        
            return response()->json([
            'code' => 400,
            'data' => $request->all()
            ], 400);
            } else {
            
            $item = Item::create($request->all());
            return response()->json([
            'code' => 200,
            'messague' => 'Cliente insertado',
            'data' => $item
            ], 200);
            }
            } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
            }
    }


    public function updateItem(Request $request, $id){
        
        try {
            $validacion = Validator::make($request->all(), [
                'nombre' => 'required',
                'precio' => 'required',
                'detalles' => 'required',
                'fk_proyecto' => 'required'
                ]);
            if($validacion->fails()){
            // Si no se cumple la validación se devuelve el mensaje de error
            return response()->json([
            'code' => 400,
            'data' => $validacion->messages()
            ], 400);
            } else {
            // Si se cumple la validación se busca el cliente
            $item = Item::find($id);
            if($item){
            // Si el cliente existe se actualiza
            $item->update($request->all());
            return response()->json([
            'code' => 200,
            'data' => 'Cliente actualizado'
            ], 200);
            } else {
            // Si el cliente no existe se devuelve un mensaje
            return response()->json([
            'code' => 404,
            'data' => 'Cliente no encontrado'
            ], 404);
            }
            }
            } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
            }
    }

    public function deleteItem($id){
        
        try {
            // Se busca el cliente
            $item = Item::find($id);
            if($item){
            // Si el cliente existe se elimina
            $item->delete($id);
            return response()->json([
            'code' => 200,
            'data' => 'Cliente eliminado'
            ], 200);
            } else {
            // Si el cliente no existe se devuelve un mensaje
            return response()->json([
            'code' => 404,
            'data' => 'Cliente no encontrado'
            ], 404);
            }
            } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
            }
    }

    public function getItem(){
        
        $item =  Item::all();

       // return $item;
        if ($item->count() > 0) {
            foreach ($item as $i){

                // $i['detalles'] = json_decode($i['detalles']);
                $i->detalles = json_decode($i->detalles, true);

            }
            return response()->json([
                'data' => $item
            ], 200);
        }else{
            return response()->json([
                'code' => 404,
                'data' => "no hay registros"
            ], 404);
        }
    }
}

