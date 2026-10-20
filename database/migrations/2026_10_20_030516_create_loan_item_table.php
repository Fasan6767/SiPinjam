<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
 Schema::create('loan_item', function (Blueprint $table) {
 $table->id();
 $table->foreignId('loan_id')->constrained()->cascadeOnDelete();
 $table->foreignId('item_id')->constrained()->restrictOnDelete();
 $table->unsignedInteger('qty')->default(1); // jumlah alat yang dipinjam
 $table->timestamps();
 });
}
public function down(): void
{
 Schema::dropIfExists('loan_item');
}
};
