<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conyuges', function (Blueprint $table) {
            $table->id();
            $table->string('dpi');
            $table->string('name');
            $table->string('last_name');
            $table->string('photo_house');
            $table->foreignId('id_customer')
                  ->nullable()
                  ->constrained('customers')
                  ->cascadeOnUpdate()
                  ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
