<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->uuid('history_id')->primary();
            $table->date('created_at');
            $table->date('updated_at');
            $table->uuid('user_id')->nullable(false);
            $table->uuid('announcement_id')->nullable(false);
        });

        Schema::table('histories', function (Blueprint $table) {
            $table->foreign('user_id')->references('user_id')->on('users');
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
        Schema::dropIfExists('histories');
        Schema::enableForeignKeyConstraints();
    }
}
