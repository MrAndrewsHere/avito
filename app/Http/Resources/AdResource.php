<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'preview' => new PhotoResource($this->preview),
            'price' => $this->price,
            'description' => $this->when(in_array('description', $request->get('fields')), $this->description),
            'photo' => $this->when(in_array('photo', $request->get('fields')), PhotoResource::collection($this->photo)),
            'created_at' => $this->created_at
        ];
    }
}
