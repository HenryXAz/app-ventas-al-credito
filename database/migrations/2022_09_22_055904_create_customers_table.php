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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('dpi');
            $table->string('name');
            $table->string('last_name');
            $table->string('personal_phone');
            $table->string('home_phone');
            $table->string('employment_phone');
            $table->string('company_name');
            $table->string('employment_address');
            $table->string('home_address');
            $table->string('email');
            $table->string('facebook');
            $table->string('photo');
            $table->string('name_reference');
            $table->string('last_name_reference');
            $table->string('phone_reference');
            $table->string('email_reference');
            $table->tinyInteger('married');
            $table->tinyInteger('rent');
            $table->foreignId('id_user')
                  ->nullable()
                  ->constrained('users')
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
        Schema::dropIfExists('customers');
    }
};
