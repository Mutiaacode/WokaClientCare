<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('ticket_logs', function (Blueprint $table) {
        $table->id();

        $table->foreignId('ticket_id')->constrained('tickets')->onDelete('cascade');
        $table->foreignId('user_id')->constrained('users');

        $table->string('status_sebelumnya')->nullable();
        $table->string('status_baru')->nullable();
        $table->text('pesan')->nullable();
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
