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
        DB::unprepared('DROP FUNCTION IF EXISTS `GET_FIXED_FINANCIAL_DEFAULT`;');
        DB::unprepared('
        CREATE FUNCTION `GET_FIXED_FINANCIAL_DEFAULT`(
            _days INT,
            get_financial_default_amount DECIMAL(10,2)
        )
        RETURNS DECIMAL(10,2)
        BEGIN
            RETURN _days * get_financial_default_amount;
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
