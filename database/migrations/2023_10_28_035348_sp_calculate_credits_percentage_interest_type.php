<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS `SP_CALCULATE_CREDIT_PERCENTAGE_INTEREST`;');

        DB::unprepared('
        CREATE PROCEDURE `SP_CALCULATE_CREDIT_PERCENTAGE_INTEREST`(
            IN a_amount DECIMAL(11, 2),
            IN a_fee DECIMAL(11,2),
            IN a_interest_type INT,
            IN a_interest_percentage INT,
            IN a_initial_date DATE
        )
        BEGIN
            DECLARE `current_date` DATE;
            SET `current_date` = a_initial_date;
        
        
            SET @interest = a_amount * (a_interest_percentage / 100);
        
            SET @default_interest_type = a_interest_type;
            SET @default_interest_percentage = a_interest_percentage;
            SET @default_fee = a_fee;
        
            CREATE TEMPORARY TABLE temp_payments_percentage(
                payment_id INT PRIMARY KEY AUTO_INCREMENT,
                balance DECIMAL(11,2),
                capital DECIMAL(11,2),
                fee DECIMAL(11,2) DEFAULT @default_fee,
                interest_type INT DEFAULT @default_interest_type,
                interest_percentage INT DEFAULT @default_interest_percentage,
                interest DECIMAL(11,2) DEFAULT @interest,
                payment_date DATE
            );
        
            CALCULATE_PAYMENTS: WHILE a_amount > 0 DO
                IF @balance < @capital THEN 
                    SET @capital = @balance;
                    SET @balance = 0;
                    SET @fee = @capital + @interest;
                    INSERT INTO temp_payments_percentage(balance, capital, fee, payment_date) VALUES(
                    @balance,
                    @capital,
                    @fee,
                    `current_date`
                );
                    LEAVE CALCULATE_PAYMENTS;
                END IF;
        
            
                SET @capital = a_fee - @interest;
                SET @balance = a_amount - (a_fee - @interest);
        
                INSERT INTO temp_payments_percentage(balance, capital, payment_date) VALUES(
                    @balance,
                    @capital,
                    `current_date`
                );
        
                  IF a_interest_type = 1 THEN
                SET `current_date` = DATE_ADD(a_initial_date, INTERVAL 1 WEEK);
            ELSEIF a_interest_type = 2 THEN
                SET `current_date` = DATE_ADD(a_initial_date, INTERVAL 2 WEEK);
            ELSEIF a_interest_type = 3 THEN
                SET `current_date` = DATE_ADD(a_initial_date, INTERVAL 1 MONTH);
            END IF;
        
                SET a_amount = @balance;
                SET a_initial_date = `current_date`;
            END WHILE;
        
            SELECT * FROM temp_payments_percentage;
        
            DROP TABLE temp_payments_percentage ;
        
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
