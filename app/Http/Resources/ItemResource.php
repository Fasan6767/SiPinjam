<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {

        if ($this->stock == 0) {
            $stockLabel = 'Habis';
        } elseif ($this->stock < 3) {
            $stockLabel = 'Menipis';
        } else {
            $stockLabel = 'Aman';
        }

        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'stock' => $this->stock,
            'stock_label' => $stockLabel,
            'available' => $this->stock > 0,
            'location' => $this->location,
            'category' => $this->whenLoaded('category', fn() => $this->category->name),
        ];
    }
}


