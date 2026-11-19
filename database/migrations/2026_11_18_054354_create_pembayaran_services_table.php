<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran_services', function (Blueprint $table) {
            $table->id();

            $table->foreignId('daftar_service_id')
                ->unique()
                ->constrained('daftar_services')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->decimal('jumlah_biaya', 12, 2);
            $table->string('jenis_pembayaran', 20)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran_services');
    }
};