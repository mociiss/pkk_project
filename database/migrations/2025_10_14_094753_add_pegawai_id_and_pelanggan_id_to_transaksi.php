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
        Schema::table('transaksi', function (Blueprint $table) {
            
            $table->unsignedBigInteger('karyawan_id')->nullable()->after('id');
            $table->unsignedBigInteger('pelanggan_id')->nullable()->after('karyawan_id');

            $table->foreign('karyawan_id')->references('id')->on('karyawan')->onDelete('cascade');
            $table->foreign('pelanggan_id')->references('id')->on('pelanggan')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            
            $table->dropForeign(['karyawan_id']);
            $table->dropForeign(['pelanggan_id']);
            $table->dropColumn(['karyawan_id', 'pelanggan_id']);

        });
    }
};
