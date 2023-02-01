<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticalsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [
            'id' => (string)$this->id,
            'name' => $this->title,
            'author' => $this->author,
            'creation_date' => $this->creation_date,
            'publication_date' => $this->publication_date,
        ];
        
        if(in_array(Route::getActionName(), ['edit', 'view'])) {
            $data['text'] = $this->description;
        }

        return $data;
    }
}
