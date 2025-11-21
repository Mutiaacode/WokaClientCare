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
    Schema::create('maintenance_schedules', function (Blueprint $table) {
        $table->id();

        $table->foreignId('contract_id')->constrained('contracts')->onDelete('cascade');
        $table->foreignId('teknisi_id')->constrained('users');

        $table->date('tanggal_kunjungan');
        $table->time('jam_kunjungan');

        $table->enum('status', ['dijadwalkan', 'selesai', 'dibatalkan'])
              ->default('dijadwalkan');

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
