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
        Schema::table('users', function (Blueprint $table) {
            $table->string('ktp_name')->nullable();
            $table->string('nik', 16)->nullable()->unique();
            $table->string('phone', 20)->nullable();
            $table->text('ktp_address')->nullable();
            $table->string('rt_rw', 20)->nullable();
            $table->string('kelurahan_desa', 100)->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->string('occupation', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['nik']);

            $table->dropColumn([
                'ktp_name',
                'nik',
                'phone',
                'ktp_address',
                'rt_rw',
                'kelurahan_desa',
                'kecamatan',
                'occupation',
            ]);
        });
    }
};