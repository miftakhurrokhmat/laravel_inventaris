<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 50)->unique();
            $table->string('nama', 100);
            $table->foreignId('kategori_id')
                  ->constrained('kategori')
                  ->restrictOnDelete();
            $table->foreignId('kondisi_id')
                  ->constrained('kondisi')
                  ->restrictOnDelete();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->date('tanggal_perolehan');
            $table->decimal('harga', 12, 2);
            $table->text('catatan')->nullable();
            $table->timestamps();
            $table->index('nama');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaris');
    }
};
