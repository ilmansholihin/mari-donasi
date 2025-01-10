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
        Schema::create('fundraising_withdrawls', function (Blueprint $table) {
            $table->id();
            $table->string('bukti');
            $table->string('nama_bank');
            $table->string('nomor_rekening');
            $table->string('nama_rekening');
            $table->unsignedBigInteger('jumlah_withdrawls');
            $table->unsignedBigInteger('jumlah_diterima');
            $table->boolean('sudah_diterima');
            $table->boolean('sudah_dikirm?');
            $table->foreignId('fundraiser_id')->constrained()->onDelete('cascade');
            $table->foreignId('fundraising_id')->constrained()->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fundraising_withdrawls');
    }
};
