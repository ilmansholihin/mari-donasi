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
        Schema::create('donaturs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nomer_hp');
            $table->unsignedBigInteger('fundraising_id');
            $table->unsignedBigInteger('total_donasi');
            $table->string('notes')->nullable();
            $table->string('bukti')->nullable();
            $table->string('status')->default('pending');
            $table->boolean('sudah_bayar')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donaturs');
    }
};
