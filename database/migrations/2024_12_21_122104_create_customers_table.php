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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->String('no_telp')->unique();
            $table->String('nama');
            $table->enum('jenis_lapangan', ['LAPANGAN BASKET','LAPANGAN VOLLY','LAPANGAN FUTSAL']);
            $table->enum('metode_pembayaran', ['DANA','GOPAY','BCA','BRI','BNI']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
