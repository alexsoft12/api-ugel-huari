<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AutorizacionDescuentoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => $this->user->name,
            'codigo_tercero' => $this->codigo_tercero,
            'descuento_mensual' => $this->descuento_mensual,
            'numero_cuotas' => $this->numero_cuotas,
            'total_descuento' => $this->total_descuento,
            'fecha_compromiso' => $this->fecha_compromiso,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_final' => $this->fecha_final,
        ];
    }
}
