<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('payments', function (Blueprint $table) {
        $table->id();

        $table->foreignId('invoice_id')->constrained('invoices')->onDelete('cascade');

        $table->decimal('jumlah_dibayar', 15, 2);
        $table->date('tanggal_pembayaran');

        $table->enum('metode', ['manual', 'transfer', 'qris', 'va'])->default('manual');
        $table->string('bukti_pembayaran')->nullable();

        $table->foreignId('diverifikasi_oleh')->nullable()->constrained('users');
        $table->dateTime('tanggal_verifikasi')->nullable();

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
