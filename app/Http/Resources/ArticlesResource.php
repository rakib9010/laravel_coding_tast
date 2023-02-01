<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
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
        $age = Cache::get('aurhorAge'.$this->id, function () {
            return Http::get('https://api.agify.io?name='.urlencode($this->author))['age'];
        });
        
        

        $data = [
            'id' => (string)$this->id,
            'name' => $this->title,
            'author' => $this->author,
            'creation_date' => $this->creation_date,
            'publication_date' => $this->publication_date,
            'age' => $age
        ];

        $action = substr(strstr($request->route()->getActionName(), '@'), 1);
        
        if(in_array($action, ['edit', 'show'])) {
            $data['text'] = $this->description;
        }

        return $data;
    }
}
