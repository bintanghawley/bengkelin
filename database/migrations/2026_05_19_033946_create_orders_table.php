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
        // 1. Ubah jadi Schema::create
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            // 2. Masukin kembali kolom-kolom orders lo yang lama di sini
            // Contoh (sesuaikan sama kebutuhan projek Bengkelin lo):
            // $table->foreignId('user_id')->nullable(); 
            // $table->string('nama_pelanggan');
            $table->integer('total_harga'); // Kolom utama yang tadinya loincer pake 'after'

            // 3. Kolom pembayaran baru langsung gabung di bawahnya (HAPUS ->after())
            $table->string('payment_method')->nullable(); 
            $table->string('payment_status')->default('pending'); // pending, konfirmasi, success, failed
            $table->string('proof_of_payment')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 4. Di fungsi down, langsung drop aja satu tabelnya kalau di-rollback
        Schema::dropIfExists('orders');
    }
};