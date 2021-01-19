<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->uuid('announcement_id')->primary();
            $table->uuid('company_id')->nullable(false);
            $table->string('announcement_title');
            $table->string('job_description');
            $table->uuid('job_position_id')->nullable(false);
            $table->string('property');
            $table->string('picture');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('welfare');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('announcements', function (Blueprint $table) {
            $table->foreign('company_id')->references('company_id')->on('companies');
            $table->foreign('job_position_id')->references('job_position_id')->on('job_positions');
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
        Schema::dropIfExists('announcements');
        Schema::enableForeignKeyConstraints();
    }
}
