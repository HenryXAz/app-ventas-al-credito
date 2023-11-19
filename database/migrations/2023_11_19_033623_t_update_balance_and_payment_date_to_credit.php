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
        DB::unprepared('DROP TRIGGER IF EXISTS `UPDATE_BALANCE_AND_PAYMENT_DATE_TO_CREDIT`;');
        DB::unprepared('
        CREATE TRIGGER `UPDATE_BALANCE_AND_PAYMENT_DATE_TO_CREDIT` 
        AFTER INSERT ON payments 
        FOR EACH ROW 
    BEGIN
        IF NEW.balance = 0 THEN
            UPDATE credits SET balance = NEW.balance, 
            next_payment_date = NEW.payment_day,
            `status` = 2 WHERE credits.id = NEW.id_credit;
        ELSE
            SELECT interest_type INTO @interest_type FROM credits
                WHERE id = NEW.id_credit;
            
            SELECT `GET_NEXT_PAYMENT_DATE`(
                NEW.payment_day,
                @interest_type
            )
            INTO @next_payment_date_of_credit
            FROM credits WHERE id = NEW.id_credit;    
        
            UPDATE credits SET balance = NEW.balance, next_payment_date = @next_payment_date_of_credit
            WHERE credits.id = NEW.id_credit; 
        END IF; 
    END
    
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
