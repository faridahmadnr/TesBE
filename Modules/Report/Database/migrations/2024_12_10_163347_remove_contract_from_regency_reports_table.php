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
        Schema::table('regency_reports', function (Blueprint $table) {
            Schema::hasColumn('regency_reports', 'contract_value') ? $table->dropColumn('contract_value') : '';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('regency_reports', function (Blueprint $table) {
            ! Schema::hasColumn('regency_reports', 'contract_value') ? $table->integer('contract_value') : '';
        });
    }
};
