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
            $table->foreignId('credit_request_type_id')
                ->nullable()
                ->index()
                ->constrained('credit_request_types')
                ->nullOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('region_reports', function (Blueprint $table) {
            $table->dropColumn('credit_request_type_id');
        });
    }
};
