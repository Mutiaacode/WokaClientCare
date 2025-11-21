<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('tickets', function (Blueprint $table) {
        $table->id();

        $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
        $table->foreignId('contract_id')->constrained('contracts')->onDelete('cascade');

        $table->foreignId('staff_id')->nullable()->constrained('users');
        $table->foreignId('teknisi_id')->nullable()->constrained('users');

        $table->string('judul');
        $table->text('deskripsi');
        $table->enum('prioritas', ['rendah', 'sedang', 'tinggi', 'urgent'])->default('rendah');
        $table->enum('status', ['open', 'in_progress', 'resolved', 'closed'])->default('open');
        $table->string('lampiran')->nullable();

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
