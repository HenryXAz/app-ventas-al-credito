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
        DB::unprepared('DROP FUNCTION IF EXISTS `GET_DAYS_BETWEEN_TWO_DATES`');

        DB::unprepared('
        CREATE FUNCTION `GET_DAYS_BETWEEN_TWO_DATES`(_initial_date DATE, _final_date DATE)
        RETURNS INT
        BEGIN
            RETURN DATEDIFF(_final_date, _initial_date);        
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
