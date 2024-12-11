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
            Schema::hasColumn('sector_reports', 'debtor') ? $table->dropColumn('debtor') : '';
            Schema::hasColumn('sector_reports', 'contract_value') ? $table->dropColumn('contract_value') : '';
            Schema::hasColumn('sector_reports', 'outstanding_value') ? $table->dropColumn('outstanding_value') : '';
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
            ! Schema::hasColumn('sector_reports', 'debtor') ? $table->integer('debtor') : '';
            ! Schema::hasColumn('sector_reports', 'contract_value') ? $table->integer('contract_value') : '';
            ! Schema::hasColumn('sector_reports', 'outstanding_value') ? $table->integer('outstanding_value') : '';
        });
    }
};
