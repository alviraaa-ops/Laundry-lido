<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('prices')) {
            return;
        }

        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->string('nama_item');
            $table->string('kategori');
            $table->decimal('harga', 12, 2);
            $table->string('satuan', 50)->nullable();
            $table->string('status')->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};