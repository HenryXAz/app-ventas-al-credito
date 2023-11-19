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
        DB::unprepared('DROP PROCEDURE IF EXISTS `SP_CALCULATE_CREDIT_PERCENTAGE_INTEREST`;');

        DB::unprepared('
        CREATE  PROCEDURE `SP_CALCULATE_CREDIT_PERCENTAGE_INTEREST`(
            IN _capital DECIMAL(10,2),
            IN _fee DECIMAL(10,2),
            IN _interest DECIMAL(10,2),
            IN _payment_frequency INT,
            IN _initial_date DATE
        )
        BEGIN	
            SET @default_fee = _fee;
            SET @balance = _capital;
            SET @current_date = _initial_date;
        
            CREATE  TEMPORARY TABLE payments_percentage_interest_temp(
                payment_number INT PRIMARY KEY AUTO_INCREMENT,
                balance DECIMAL(10,2),
                fee DECIMAL(10,2) DEFAULT @default_fee,
                interest DECIMAL(10,2),
                recovered_capital DECIMAL(10,2),
                payment_date DATE,
                financial_default DECIMAL(10,2) DEFAULT 0
            );
        
            CALCULATE_PAYMENTS: WHILE @balance > 0 DO
            
                IF @balance < @recovered_capital THEN
                    SET @recovered_capital = @balance;
                    SET @interest_amount = (@recovered_capital * (_interest / 100));
                    SET @balance = 0;
                    SET @default_fee = @recovered_capital + @interest_amount;
                
                    INSERT INTO payments_percentage_interest_temp(balance, recovered_capital, interest, fee, payment_date)
                    VALUES(
                        @balance,
                        @recovered_capital,
                        @interest_amount,
                        @default_fee,
                        @current_date
                    );
                
                    LEAVE CALCULATE_PAYMENTS;
                END IF;
            
                SET @interest_amount = (@balance * (_interest / 100));
                SET @recovered_capital = @default_fee - @interest_amount;
                SET @balance = @balance - @recovered_capital;
                    
                INSERT INTO payments_percentage_interest_temp(balance, recovered_capital, interest, payment_date)
                VALUES(
                    @balance,
                    @recovered_capital,
                    @interest_amount,
                    @current_date
                );
            
                SELECT `GET_NEXT_PAYMENT_DATE`(@current_date, _payment_frequency) INTO @current_date;
            END WHILE;
            
            SELECT * FROM payments_percentage_interest_temp;
            DROP  TABLE payments_percentage_interest_temp;
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
