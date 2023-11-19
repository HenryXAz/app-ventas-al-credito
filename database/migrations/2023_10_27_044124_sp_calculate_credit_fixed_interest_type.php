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
            IN _capital DECIMAL(10,2),
            IN _fee DECIMAL(10,2),
            IN _interest DECIMAL(10,2),
            IN _payment_frequency INT,
            IN _initial_date DATE
        )
        BEGIN
            SET @balance = _capital;
            SET @default_fee = _fee;
            SET @current_date = _initial_date;
            SET @interest_amount = 0.00;
        
            SELECT `GET_NEXT_PAYMENT_DATE`(@current_date, _payment_frequency) INTO @next_payment_date;
        
            SELECT `GET_FIXED_INTEREST`(
                @current_date,
                @next_payment_date,
                _interest,
                @interest_amount,
                _payment_frequency
            ) INTO @interest_amount;
        
            SET @recovered_capital = @default_fee - @interest_amount;
        
            CREATE TEMPORARY TABLE payments_fixed_interest(
                payment_number INT PRIMARY KEY AUTO_INCREMENT,
                balance DECIMAL(10,2),
                fee DECIMAL(10,2) DEFAULT @default_fee,
                interest DECIMAL(10,2),
                recovered_capital DECIMAL(10,2),
                payment_date DATE
            );  
        
            CALCULATE_PAYMENTS: WHILE @balance > 0 DO
                IF @balance < @recovered_capital THEN
                    SET @recovered_capital = @balance;
                    SET @balance = 0;
                   
                    SET @default_fee = @recovered_capital + @interest_amount;
        
                    INSERT INTO payments_fixed_interest(balance, fee, recovered_capital, interest, payment_date)
                        VALUES(
                            @balance,
                            @default_fee,
                            @recovered_capital,
                            @interest_amount,
                            @current_date
                        );
        
                    LEAVE CALCULATE_PAYMENTS;
                END IF;
        
                IF _payment_frequency = 3 THEN
                    SET @recovered_capital = @default_fee - @interest_amount;
                END IF; 
                SET @balance = @balance - @recovered_capital;
        
                INSERT INTO payments_fixed_interest(balance, recovered_capital, interest, payment_date)
                VALUES(
                    @balance,
                    @recovered_capital,
                    @interest_amount,
                    @current_date
                );
            
                SET @current_date = @next_payment_date;
                SELECT `GET_NEXT_PAYMENT_DATE`(@current_date, _payment_frequency) INTO @next_payment_date;
                SELECT `GET_FIXED_INTEREST`(
                    @current_date,
                    @next_payment_date,
                    _interest,
                    @interest_amount,
                    _payment_frequency
                ) INTO @interest_amount;
            END WHILE;
        
            SELECT * FROM payments_fixed_interest;
            DROP TEMPORARY TABLE payments_fixed_interest;
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
