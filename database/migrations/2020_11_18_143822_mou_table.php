<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MouTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mou', function (Blueprint $table) {
            $table->uuid('mou_id')->primary();
            $table->uuid('company_id')->nullable(false);
            $table->string('mou_link');
            $table->string('mou_type');
            $table->string('contact_period');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('mou', function (Blueprint $table) {
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
        Schema::dropIfExists('mou');
        Schema::enableForeignKeyConstraints();
    }
}
