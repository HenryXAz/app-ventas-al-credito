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
        DB::unprepared('DROP PROCEDURE IF EXISTS `SP_CALCULATE_CREDIT_FIXED_INTEREST`;');

        DB::unprepared('
        CREATE PROCEDURE `SP_CALCULATE_CREDIT_FIXED_INTEREST`(
            IN a_amount DECIMAL(11,2),
            IN a_fee DECIMAL(11,2),
            IN a_interest DECIMAL(11, 2),
            IN a_payment_frequency INT,
            IN a_initial_date DATE
        )
        BEGIN
            SET @current_date = a_initial_date;
        
            SET @default_interest = a_interest;
            SET @default_fee = a_fee;
            SET @default_payment_frequency = a_payment_frequency;
        
            CREATE TEMPORARY TABLE temp_payments_fixed_interest(
                payment_id INT PRIMARY KEY AUTO_INCREMENT,
                fee DECIMAL(11,2) DEFAULT @default_fee,
                balance DECIMAL(11,2),
                capital DECIMAL(11,2),
                interest DECIMAL(11,2) DEFAULT @default_interest,
                payment_date DATE,
                payment_frequency INT DEFAULT @default_payment_frequency
            );
        
        
            CALCULATE_PAYMENTS:WHILE a_amount > 0 DO
                IF @balance < @capital THEN
                    SET @capital = @balance;
                    SET @balance = 0;
                    SET @fee = @capital + @default_interest;
        
                    INSERT INTO temp_payments_fixed_interest(balance, capital, fee, payment_date) VALUES(
                        @balance,
                        @capital,
                        @fee,
                        @current_date
                    );
        
                    LEAVE CALCULATE_PAYMENTS;
                END IF; 
                SET @capital = a_fee - a_interest;
                SET @balance = a_amount - @capital;
        
                INSERT INTO temp_payments_fixed_interest(balance, capital, payment_date) VALUES(
                    @balance, 
                    @capital,
                    @current_date
                );
        
                IF a_payment_frequency = 1 THEN
                    SET @current_date = DATE_ADD(a_initial_date, INTERVAL 1 WEEK);
                ELSEIF a_payment_frequency = 2 THEN
                    SET @current_date = DATE_ADD(a_initial_date, INTERVAL 2 WEEK);
                ELSEIF a_payment_frequency = 3 THEN
                    SET @current_date = DATE_ADD(a_initial_date, INTERVAL 1 MONTH);
                END IF;
        
                SET a_initial_date = @current_date;
                set a_amount = @balance;
            END WHILE;
        
        
            SELECT * FROM temp_payments_fixed_interest;
        
            DROP TABLE temp_payments_fixed_interest;
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
