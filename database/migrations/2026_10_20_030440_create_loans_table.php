<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
 Schema::create('loans', function (Blueprint $table) {
 $table->id();
 $table->foreignId('user_id')->constrained()->restrictOnDelete();
 $table->date('loan_date'); // tanggal pinjam
 $table->date('due_date'); // batas kembali
 $table->date('returned_at')->nullable(); // tanggal dikembalikan, kosong jika belum
 $table->string('status', 20)->default('dipinjam'); // dipinjam / dikembalikan
 $table->text('notes')->nullable(); // keperluan
 $table->timestamps();
 });
}
public function down(): void
{
 Schema::dropIfExists('loans');
}

};
