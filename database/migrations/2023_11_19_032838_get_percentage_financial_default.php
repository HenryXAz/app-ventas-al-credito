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
        DB::unprepared('DROP FUNCTION IF EXISTS `GET_PERCENTAGE_FINANCIAL_DEFAULT`;');
        DB::unprepared('
        CREATE FUNCTION `GET_PERCENTAGE_FINANCIAL_DEFAULT`(
            _financial_default_amount DECIMAL(10,2),
            _balance DECIMAL(10,2)
        )
        RETURNS DECIMAL(10,2)
        BEGIN
            RETURN _balance * (_financial_default_amount / 100);
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
