<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProyectoController extends Controller
{
    public function getProyectos(){
        
        $proyecto =  Proyecto::all();
        
        if ($proyecto->count() > 0) {
            foreach ($proyecto as $p){
                $items = Item::select(
                    'item.id',
                    'item.nombre',
                    'item.precio',
                    'item.detalles',)
                ->where('item.fk_proyecto','=',$p->id)
                ->get();
                foreach ($items as $i){   
                    $i->detalles = json_decode($i->detalles, true);
    
                }
                $p->items = $items;
            }

            return response()->json([
                'data' => $proyecto
            ], 200);
        }else{
            return response()->json([
                'code' => 404,
                'data' => "no hay registros"
            ], 404);
        }
    }

    public function getUnProyecto($id){
        $total = 0;
        $proyecto =  Proyecto::select(
            'proyecto.id',
            'proyecto.nombre',
            'proyecto.descripcion',)
        ->where('proyecto.fk_usuario','=',$id)
        ->get();
       
        if ($proyecto) {
           if($proyecto->count() == 1) {
                $items = Item::select(
                    'item.id',
                    'item.nombre',
                    'item.precio',
                    'item.detalles',)
                ->where('item.fk_proyecto','=',$proyecto[0]->id)
                ->get();
                foreach ($items as $i){   
                    $i->detalles = json_decode($i->detalles, true);
                    $total+= $i->precio;
    
                }
                $proyecto[0]->items = $items;
                $proyecto[0]->total_precio = $total;
                $total = 0;
               
            

            return response()->json([
                'data' => $proyecto
            ], 200);
        } else {
            foreach ($proyecto as $p){
                $items = Item::select(
                    'item.id',
                    'item.nombre',
                    'item.precio',
                    'item.detalles',)
                ->where('item.fk_proyecto','=',$p->id)
                ->get();
                foreach ($items as $i){   
                    $i->detalles = json_decode($i->detalles, true);
                    $total+= $i->precio;

    
                }
                $p->items = $items;
                $p->total_precio = $total;
                $total = 0;
            }
           
            return response()->json([
                'data' => $proyecto
            ], 200);
    }

        }else{
            return response()->json([
                'code' => 404,
                'data' => "no hay registros"
            ], 404);
        }
    }

    public function createProyecto(Request $request){
        
        try {
            
            $validacion = Validator::make($request->all(), [
                'nombre' => 'required',
                'descripcion' => 'required',
               
                'fk_usuario' => 'required'
                ]);
            if($validacion->fails()){
        
            return response()->json([
            'code' => 400,
            'data' => $request->all()
            ], 400);
            } else {
            
            $proyecto = Proyecto::create($request->all());
            return response()->json([
            'code' => 200,
            'messague' => 'Proyecto Creado',
            'data' => $proyecto
            ], 200);
            }
            } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
            }
    }


    public function updateProyecto(Request $request, $id){
        
        try {
            $validacion = Validator::make($request->all(), [
                'nombre' => 'required',
                'descripcion' => 'required',
               
                'fk_usuario' => 'required'
                ]);
            if($validacion->fails()){
            // Si no se cumple la validación se devuelve el mensaje de error
            return response()->json([
            'code' => 400,
            'data' => $validacion->messages()
            ], 400);
            } else {
            // Si se cumple la validación se busca el cliente
            $proyecto = Proyecto::find($id);
            if($proyecto){
            // Si el cliente existe se actualiza
            $proyecto->update($request->all());
            return response()->json([
            'code' => 200,
            'data' => 'Proyecto actualizado'
            ], 200);
            } else {
            // Si el cliente no existe se devuelve un mensaje
            return response()->json([
            'code' => 404,
            'data' => 'Proyecto no encontrado'
            ], 404);
            }
            }
            } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
            }
    }

    public function deleteProyecto($id){
        
        try {
            // Se busca el cliente
            $proyecto = Proyecto::find($id);
            if($proyecto){
            // Si el cliente existe se elimina
            $proyecto->delete($id);
            return response()->json([
            'code' => 200,
            'data' => 'Proyecto eliminado'
            ], 200);
            } else {
            // Si el cliente no existe se devuelve un mensaje
            return response()->json([
            'code' => 404,
            'data' => 'Proyecto no encontrado'
            ], 404);
            }
            } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
            }
    }
}

