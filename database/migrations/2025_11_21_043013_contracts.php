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
    Schema::create('contracts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
        $table->foreignId('produk_id')->constrained('products')->onDelete('cascade');

        $table->string('nomor_kontrak')->unique();
        $table->enum('tipe_kontrak', ['langganan', 'satu_kali']);
        $table->enum('periode_tagihan', ['bulanan', 'tahunan'])->nullable();

        $table->string('nama_layanan');
        $table->date('tanggal_mulai');
        $table->date('tanggal_berakhir');

        $table->decimal('harga_layanan', 15, 2);
        $table->enum('status', ['aktif', 'kedaluwarsa', 'menunggu'])->default('menunggu');

        $table->string('file_kontrak')->nullable();
        $table->text('catatan')->nullable();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

