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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pinjam', 30)->unique();
            $table->foreignId('inventaris_id')
                  ->constrained('inventaris')
                  ->cascadeOnDelete();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->restrictOnDelete();
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali')->nullable();
            $table->date('rencana_kembali');
            $table->enum('status', ['dipinjam', 'kembali', 'terlambat'])
                  ->default('dipinjam');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
