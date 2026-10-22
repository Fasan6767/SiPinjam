<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'loan_date' => $this->loan_date->toDateString(),
            'due_date' => $this->due_date->toDateString(),
            'returned_at' => $this->returned_at?->toDateString(),
            'status' => $this->status,
            'notes' => $this->notes,
            'items' => $this->whenLoaded('items', fn() => $this->items->map(fn($alat) => [
                'code' => $alat->code,
                'name' => $alat->name,
                'qty' => $alat->pivot->qty,
            ])),
        ];
    }
}
