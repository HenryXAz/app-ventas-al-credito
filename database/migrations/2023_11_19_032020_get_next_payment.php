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
        DB::unprepared('DROP FUNCTION IF EXISTS `GET_NEXT_PAYMENT_DATE`');

        db::unprepared('
        CREATE  FUNCTION `GET_NEXT_PAYMENT_DATE`(
            _date DATE,
            _interval INT
        )
        RETURNS DATE
        BEGIN
            IF _interval = 1 THEN
                RETURN DATE_ADD(_date, INTERVAL 1 WEEK);
            END IF;
        
            IF _interval = 2 THEN
                RETURN DATE_ADD(_date, INTERVAL 2 WEEK);	
            END IF;
            
            IF _interval = 3 THEN
                RETURN DATE_ADD(_date, INTERVAL 1 MONTH);
            END IF;
        
            SIGNAL SQLSTATE \'45000\' SET MESSAGE_TEXT = \'The interval is not valid: the entry should be 1(one week), 2(two week) or 3(one month)\';
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
