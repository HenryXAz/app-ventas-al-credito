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
        Schema::create('payments', function (Blueprint $table) {
          $table->id();
          $table->string("payment_number");
          $table->date("payment_date");
          $table->float("interest");
          $table->float("fee");
          $table->float("capital");
          $table->float("balance");
          $table->string("status");
          $table->float("financial_default")->nullable()->default(0);
          $table->foreignId("id_credit")
            ->nullable()
            ->constrained("credits")
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
        Schema::dropIfExists('payments');
    }
};
