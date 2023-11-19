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
        DB::unprepared('DROP FUNCTION IF EXISTS `GET_FIXED_INTEREST`;');
        DB::unprepared('
        CREATE FUNCTION `GET_FIXED_INTEREST`(
            _initial_date DATE,
            _final_date DATE,
            _interest DECIMAL(10,2),
            _current_interest_amount DECIMAL(10,2),
            _payment_frequency INT
        )
        RETURNS DECIMAL(10,2)
        BEGIN
            IF _payment_frequency = 3 OR _current_interest_amount = 0.00 THEN
                SELECT `GET_DAYS_BETWEEN_TWO_DATES`(_initial_date, _final_date) INTO @days;
                RETURN @days * _interest;
            END IF; 
            
            RETURN _current_interest_amount;
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
