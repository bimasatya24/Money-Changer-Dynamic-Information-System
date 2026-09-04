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
        Schema::create('rate_histories', function (Blueprint $table) {
            $table->id();
            $table->string('mata_uang');
            $table->string('pecahan');
            $table->decimal('beli', 10, 2);
            $table->decimal('jual', 10, 2);
            $table->date('tanggal');
            $table->timestamps();

            $table->unique(['mata_uang', 'pecahan', 'tanggal'], 'unique_rate_history');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rate_histories');
    }
};
