<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Loan extends Model
{
 protected $fillable = ['user_id', 'loan_date', 'due_date', 'returned_at', 'status', 'notes'];
 // Ubah kolom tanggal menjadi objek tanggal
 // agar mudah diformat, misalnya -> format('d/m/Y')
 protected function casts(): array
 {
 return [
 'loan_date' => 'date',
 'due_date' => 'date',
 'returned_at' => 'date',
 ];
 }

 public function user(): BelongsTo
 {
  return $this->belongsTo(User::class);
 }

 public function items(): BelongsToMany
 {
  // 'loan_item' = nama tabel pivot, wajib ditulis karena berbeda dari tebakan Laravel (item_loan)
  return $this->belongsToMany(Item::class, 'loan_item')->withPivot('qty')->withTimestamps();
 }
}





