<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Palabras extends ResourceCollection
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
         $this->collection->map(function($data) {
 
                 return
                 [
                    'PALABRA'=>$data['palabra'],
                    'PRONUNCIACION'=>$data['pronunciar'],
                    'USUARIO'=>$data['fk_user'],
                    'IDIOMA'=>$data['fk_idioma']
                 ];
             });
     }
}