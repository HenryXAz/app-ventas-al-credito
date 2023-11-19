<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('DROP FUNCTION IF EXISTS `GET_PERCENTAGE_INTEREST`;');
        DB::unprepared('
        CREATE FUNCTION `GET_PERCENTAGE_INTEREST`(
            _balance DECIMAL(10,2),
            _interest DECIMAL(10,2)
        )
        RETURNS DECIMAL(10,2)
        BEGIN
            RETURN (_balance * (_interest / 100));
        END        
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
