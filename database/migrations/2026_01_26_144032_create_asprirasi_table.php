<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asprirasi', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['Menunggu', 'Diproses', 'Selesai']);
            $table->foreignId('kategori_id')->constrained('kategori')->onDelete('cascade');
             $table->text('feedback');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asprirasi');
    }
};
