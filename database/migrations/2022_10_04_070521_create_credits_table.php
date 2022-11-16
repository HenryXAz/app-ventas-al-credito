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
        Schema::create('credits', function (Blueprint $table) {
          $table->id();
          $table->float("capital");
          $table->float("balance")->default(0.0);
          $table->string("interest_type");
          $table->float("interest_rate");
          $table->string("payment_frequency");
          $table->string("car_image");
          $table->float("fee");
          $table->string("name_customer");
          $table->string("dpi_customer");
          $table->string("status");
          $table->foreignId("id_customer")
          ->nullable()
          ->constrained('customers')
          ->cascadeOnUpdate()
          ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credits');
    }
};
