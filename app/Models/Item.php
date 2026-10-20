<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
 use HasFactory; // dipakai di Sesi 2.3 untuk membuat data dummy
 protected $fillable = ['category_id', 'code', 'name', 'stock', 'location', 'description'];
 // Scope: cara pintas memanggil query yang sering dipakai, Item::available()
 public function scopeAvailable(Builder $query): void
 {
 $query->where('stock', '>', 0);
 }

 public function category(): BelongsTo
 {
    return $this->belongsTo(Category::class);
 }

 public function loans(): BelongsToMany
 {
    // 'loan_item' = nama tabel pivot, wajib ditulis karena berbeda dari tebakan Laravel (item_loan)
    return $this->belongsToMany(Loan::class, 'loan_item')->withPivot('qty')->withTimestamps();
 }

}





