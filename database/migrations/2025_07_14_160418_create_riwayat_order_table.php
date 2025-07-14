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
        Schema::create('riwayat_order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('toko_id');
            $table->foreignId('user_id');
            $table->string('no_meja');
            $table->string('nama_produk');
            $table->string('kategori');
            $table->string('harga');
            $table->string('qty');
            $table->string('total_harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_order');
    }
};
