<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->uuid('application_id')->primary();
            $table->uuid('announcement_id')->nullable(false);
            $table->date('application_date');
            $table->string('status');
            $table->string('name_title');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('tel_no');
            $table->string('resume_link');
            $table->string('path_file');
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->foreign('announcement_id')->references('announcement_id')->on('announcements');
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
        Schema::dropIfExists('applications');
        Schema::enableForeignKeyConstraints();
    }
}
