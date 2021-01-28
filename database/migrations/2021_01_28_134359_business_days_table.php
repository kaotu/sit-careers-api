<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BusinessDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_days', function (Blueprint $table) {
            $table->uuid('business_day_id')->primary();
            $table->string('business_day_type');
            $table->uuid('company_id')->nullable(false);
            $table->string('start_business_day', 20);
            $table->string('end_business_day', 20);
            $table->string('start_business_time', 6);
            $table->string('end_business_time', 6);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('business_days', function (Blueprint $table) {
            $table->foreign('company_id')->references('company_id')->on('companies');
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
        Schema::dropIfExists('business_days');
        Schema::enableForeignKeyConstraints();
    }
}
