<?php

namespace App\Http\Controllers\API;

use App\Models\AutorizacionDescuento;
use App\Http\Resources\AutorizacionDescuentoResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Validator;

class AutorizacionDescuentoController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $autorizacionDescuentos = AutorizacionDescuento::with('user')->paginate();
        return AutorizacionDescuentoResource::collection($autorizacionDescuentos);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'user_id' => 'required',
            'codigo_tercero' => 'required',
            'descuento_mensual' => 'required|numeric',
            'numero_cuotas' => 'required|integer',
            'total_descuento' => 'required|numeric',
            'fecha_compromiso' => 'required',
            'fecha_inicio' => 'required',
            'fecha_final' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error de validación.', $validator->errors());
        }
        $autorizacionDescuento = AutorizacionDescuento::create($input);
        return $this->sendResponse(
            new AutorizacionDescuentoResource($autorizacionDescuento),
            'Autorizacion de descuento creada con éxito'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param AutorizacionDescuento $autorizacionDescuento
     * @return JsonResponse
     */
    public function show(AutorizacionDescuento $autorizacionDescuento)
    {
        return $this->sendResponse(
            new AutorizacionDescuentoResource($autorizacionDescuento),
            'Autorizacion de descuento recuperada con éxito'
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param AutorizacionDescuento $autorizacionDescuento
     * @return JsonResponse
     */
    public function update(Request $request, AutorizacionDescuento $autorizacionDescuento)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'user_id' => 'required',
            'codigo_tercero' => 'required',
            'descuento_mensual' => 'required|numeric',
            'numero_cuotas' => 'required|integer',
            'total_descuento' => 'required|numeric',
            'fecha_compromiso' => 'required',
            'fecha_inicio' => 'required',
            'fecha_final' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error de validación.', $validator->errors());
        }

        $autorizacionDescuento->user_id = $input['user_id'];
        $autorizacionDescuento->codigo_tercero = $input['codigo_tercero'];
        $autorizacionDescuento->descuento_mensual = $input['descuento_mensual'];
        $autorizacionDescuento->numero_cuotas = $input['numero_cuotas'];
        $autorizacionDescuento->total_descuento = $input['total_descuento'];
        $autorizacionDescuento->fecha_compromiso = $input['fecha_compromiso'];
        $autorizacionDescuento->fecha_inicio = $input['fecha_inicio'];
        $autorizacionDescuento->fecha_final = $input['fecha_final'];
        $autorizacionDescuento->save();

        return $this->sendResponse(
            new AutorizacionDescuentoResource($autorizacionDescuento),
            'Autorizacion de descuento actualizada con éxito'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AutorizacionDescuento $autorizacionDescuento
     * @return JsonResponse
     */
    public function destroy(AutorizacionDescuento $autorizacionDescuento)
    {
        $autorizacionDescuento->delete();

        return $this->sendResponse([], 'Autorizacion de descuento eliminada con éxito');
    }
}
