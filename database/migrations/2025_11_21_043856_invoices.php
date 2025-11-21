<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('invoices', function (Blueprint $table) {
        $table->id();

        $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
        $table->foreignId('contract_id')->constrained('contracts')->onDelete('cascade');

        $table->string('nomor_invoice')->unique();
        $table->date('tanggal_terbit');
        $table->date('tanggal_jatuh_tempo');

        $table->decimal('subtotal', 15, 2);
        $table->decimal('pajak', 15, 2)->default(0);

        $table->string('periode')->nullable();
        $table->decimal('diskon', 15, 2)->default(0);

        $table->decimal('total', 15, 2);
        $table->enum('status', ['paid', 'unpaid', 'overdue'])->default('unpaid');
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
