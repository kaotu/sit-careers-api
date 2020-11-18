<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->uuid('address_id')->primary();
            $table->string('address_one');
            $table->string('address_two');
            $table->string('lane');
            $table->string('road');
            $table->string('sub-district');
            $table->string('district');
            $table->string('province');
            $table->string('postal_code');
            $table->uuid('company_id')->nullable(false);
            $table->foreign('company_id')->references('company_id')->on('company');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('address');
        Schema::enableForeignKeyConstraints();
    }
}
