<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Palabras_Palabras_r extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function toArray($request)
    {
        return
            $this->collection->map(function ($data) {
                return
                    [
                        'IDPALABRARELACION' => $data['id'],
                        'PALABRA' => $data['palabra_id_1'],
                        'TRADUCCION' => $data['palabra_id_2'],
                        'RELACION' => $data['relacion']
                    ];
            });
    }
}
