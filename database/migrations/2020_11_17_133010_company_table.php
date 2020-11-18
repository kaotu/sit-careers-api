<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->uuid('company_id')->primary();
            $table->string('company_name_th');
            $table->string('company_name_en');
            $table->string('company_type');
            $table->string('description');
            $table->string('about_us');
            $table->string('logo');
            $table->string('business_days');
            $table->string('business_time');
            $table->integer('tel_no');
            $table->integer('phone_no');
            $table->string('website');
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
        Schema::dropIfExists('company');
        Schema::enableForeignKeyConstraints();
    }
}
