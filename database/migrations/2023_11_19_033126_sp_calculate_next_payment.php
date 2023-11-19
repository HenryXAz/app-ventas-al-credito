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
        DB::unprepared('DROP PROCEDURE IF EXISTS `SP_CALCULATE_NEXT_PAYMENT`;');
        DB::unprepared('
        CREATE PROCEDURE `SP_CALCULATE_NEXT_PAYMENT`(
            IN _credit_id INT,
            IN _fee DECIMAL(10,2),
            IN _custom_financial_default DECIMAL(10,2)
        )
        BEGIN
            WITH get_main_credit_info AS (
                SELECT  
                    balance,
                    interest_type,
                    interest_rate,
                    payment_frequency,
                    next_payment_date AS `current_payment_date`,
                    financial_default_type,
                    financial_default_amount,
                    `GET_DAYS_BETWEEN_TWO_DATES`(NOW(), next_payment_date) AS `days_late`,
                    `GET_NEXT_PAYMENT_DATE`(next_payment_date, payment_frequency) AS `next_payment_date`
                FROM credits 
                WHERE id = _credit_id
            ),
            get_payment_number AS (
                SELECT (COUNT(*) + 1 ) AS `payment_number` FROM payments 
                    WHERE payments.id_credit = _credit_id
            ),
            get_interest AS(
                SELECT CASE
                    WHEN interest_type = 1 THEN 
                        `GET_FIXED_INTEREST`(
                            IF(days_late <= 0, current_payment_date, NOW()),
                            IF(days_late <= 0, next_payment_date, current_payment_date),
                            interest_rate,
                            0,
                            payment_frequency) 
                    WHEN interest_type = 2 THEN
                        `GET_PERCENTAGE_INTEREST`(balance,interest_rate)
                END
                AS `interest_amount` FROM get_main_credit_info
            ),
            get_financial_default AS (
                SELECT 
                    CASE
                        WHEN days_late > 0 THEN 0
                        WHEN _custom_financial_default >= 0 THEN _custom_financial_default
                        WHEN financial_default_type = 1 THEN
                            `GET_FIXED_FINANCIAL_DEFAULT`((days_late * -1), financial_default_amount)
                        WHEN financial_default_type = 2 THEN
                            `GET_PERCENTAGE_FINANCIAL_DEFAULT`(financial_default_amount, balance)
                        ELSE 0
                    END
                    AS `financial_default_amount`
                FROM get_main_credit_info
            ),
            get_recovered_capital AS(
                SELECT CASE
                    WHEN _fee < (i.interest_amount + f.financial_default_amount) THEN 0	
                    WHEN c.balance <= (_fee - (i.interest_amount + f.financial_default_amount) ) THEN
                        c.balance
                        ELSE
                        _fee - (i.interest_amount + f.financial_default_amount)
                    END AS `recovered_capital`
                    FROM get_main_credit_info c
                    JOIN get_interest i ON 1 = 1
                    JOIN get_financial_default f ON 1 = 1
            ),
            get_new_balance AS (
                SELECT CASE
                    WHEN c.balance <= r.recovered_capital  THEN
                        0
                    ELSE
                        (c.balance - r.recovered_capital)
                    END AS `new_balance`
                FROM get_main_credit_info c
                JOIN get_recovered_capital r ON 1 = 1
            ),
            get_fee AS(
                SELECT CASE
                    WHEN c.balance <= r.recovered_capital THEN
                        r.recovered_capital + i.interest_amount + f.financial_default_amount
                    ELSE 
                        _fee
                    END AS `fee`
                FROM get_main_credit_info c
                JOIN get_recovered_capital r ON 1 = 1
                JOIN get_interest i ON 1 = 1
                JOIN get_financial_default f ON 1 = 1
             )
            SELECT get_main_credit_info.*,
                get_payment_number.payment_number,
                get_interest.interest_amount,
                get_financial_default.financial_default_amount,
                get_recovered_capital.recovered_capital,
                get_new_balance.new_balance,
                get_fee.fee
            FROM get_main_credit_info
            JOIN get_payment_number ON 1 = 1
            JOIN get_interest ON 1 = 1
            JOIN get_financial_default ON 1 = 1
            JOIN get_recovered_capital ON 1 = 1
            JOIN get_new_balance ON 1 = 1
               JOIN get_fee ON 1 = 1;
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
