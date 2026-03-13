<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration 
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE asprirasi MODIFY COLUMN status ENUM('Menunggu','Diproses','Selesai','Ditolak') NOT NULL DEFAULT 'Menunggu'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE asprirasi MODIFY COLUMN status ENUM('Menunggu','Diproses','Selesai') NOT NULL DEFAULT 'Menunggu'");
    }
};
