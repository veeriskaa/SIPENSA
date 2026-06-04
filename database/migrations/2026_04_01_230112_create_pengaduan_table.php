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
        Schema::create('pengaduan', function (Blueprint $table) {
    $table->id('id_pengaduan');
    $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
    $table->string('judul');
    $table->text('deskripsi');
    $table->string('bukti')->nullable();
    $table->string('status')->default('proses');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};
