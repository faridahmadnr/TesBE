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
            $table->dropColumn('debtor');
            $table->dropColumn('contract_value');
            $table->dropColumn('outstanding_value');
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
            $table->string('debtor')->nullable();
            $table->string('contract_value')->nullable();
            $table->string('outstanding_value')->nullable();
        });
    }
};
