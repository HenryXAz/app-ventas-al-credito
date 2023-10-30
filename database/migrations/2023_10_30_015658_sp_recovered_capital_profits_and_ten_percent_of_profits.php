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
        DB::unprepared('DROP PROCEDURE IF EXISTS `SP_GET_RECOVERED_CAPITAL_PROFITS_AND_TEN_PERCENT_OF_PROFITS`;');

        DB::unprepared('
        CREATE PROCEDURE `SP_GET_RECOVERED_CAPITAL_PROFITS_AND_TEN_PERCENT_OF_PROFITS`(
            IN _start_date DATE,
            IN _end_date DATE,
            OUT _profits DECIMAL(10,2),
            OUT _recovered_capital DECIMAL(10,2),
            OUT _ten_percent_of_profits DECIMAL(10,2)
        )
        BEGIN
            SELECT SUM(financial_default + interest), SUM(capital) INTO _profits, _recovered_capital 
                FROM payments WHERE status = \'2\' AND payment_day BETWEEN _start_date AND _end_date;
            SET _ten_percent_of_profits = _profits * 0.1;
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
