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
        Schema::table('sector_reports', function (Blueprint $table) {
            $table->integer('debitor')->nullable();
            $table->dropColumn('target');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sector_reports', function (Blueprint $table) {
            $table->dropColumn('debitor');
        });
    }
};
