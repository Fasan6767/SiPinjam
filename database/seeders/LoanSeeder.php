<?php
namespace Database\Seeders;
use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Seeder;
class LoanSeeder extends Seeder
{
 public function run(): void
 {
 $mahasiswa = User::where('role', 'mahasiswa')->get();
 // 5 mahasiswa acak, masing-masing meminjam 2 alat
 foreach ($mahasiswa->random(5) as $user) {
 $loan = $user->loans()->create([
 'loan_date' => now()->subDays(2),
 'due_date' => now()->addDay(),
 'status' => 'dipinjam',
 'notes' => 'Praktikum Elektronika Dasar',
 ]);
 $alat = Item::available()->inRandomOrder()->take(2)->get();
 foreach ($alat as $item) {
 $loan->items()->attach($item->id, ['qty' => 1]); // simpan ke tabel loan_item
 $item->decrement('stock'); // stok alat berkurang 1
 }
 }
 }
}

