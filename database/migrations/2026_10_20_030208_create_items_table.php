<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
 Schema::create('items', function (Blueprint $table) {
 $table->id();
 $table->foreignId('category_id')->constrained()->restrictOnDelete();
 $table->string('code', 20)->unique(); // kode alat, misalnya ALT0001
 $table->string('name', 150);
 $table->unsignedInteger('stock')->default(0);
 $table->text('description')->nullable();
 $table->timestamps();
 });
}
public function down(): void
{
 Schema::dropIfExists('items');
}

};
