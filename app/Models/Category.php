<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

public function items(): HasMany
{
    return $this->hasMany(Item::class);
}
 // Kolom yang boleh diisi lewat create() dan update()
 protected $fillable = ['name', 'description'];
}





