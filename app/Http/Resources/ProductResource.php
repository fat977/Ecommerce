<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name_en' => $this->name_en,
            'code'=>$this->when($this->code ==14785,$this->code),
            'category' => new CategoryResource($this->whenLoaded('category'))
        ];
    }
}
