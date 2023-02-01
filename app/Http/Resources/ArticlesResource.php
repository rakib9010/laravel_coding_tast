<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticlesResource extends JsonResource
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

        $action = substr(strstr($request->route()->getActionName(), '@'), 1);
        
        if(in_array($action, ['edit', 'show'])) {
            $data['text'] = $this->description;
        }

        return $data;
    }
}
