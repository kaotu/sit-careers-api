<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->uuid('company_id')->primary();
            $table->string('company_name_th');
            $table->string('company_name_en');
            $table->string('company_type');
            $table->string('description');
            $table->string('about_us');
            $table->string('logo')->nullable();
            $table->string('business_days', 50);
            $table->string('business_time', 50);
            $table->string('tel_no', 10);
            $table->string('phone_no', 10);
            $table->string('website');
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('companies');
        Schema::enableForeignKeyConstraints();
    }
}
