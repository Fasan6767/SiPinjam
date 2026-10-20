<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('categories', function (Blueprint $table) {
        $table->id();                               // kolom id, otomatis bertambah
        $table->string('name', 100)->unique();      // nama kategori, tidak boleh kembar
        $table->text('description')->nullable();    // deskripsi, boleh kosong
        $table->timestamps();                       // kolom created_at dan updated_at
    });
}

public function down(): void
{
 Schema::dropIfExists('categories');
}

};
