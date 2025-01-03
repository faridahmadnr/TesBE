<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sector_reports', function (Blueprint $table) {
            $table->id();

            $table->foreignId('business_type_id')
            ->nullable()
            ->index()
            ->constrained('business_types')
            ->nullOnDelete()
            ->cascadeOnUpdate();

            $table->date('date');

            $table->integer('debtor');
            $table->integer('contract_value');
            $table->integer('outstanding_value');
            $table->integer('target');
            $table->integer('realization');


            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->foreignId('deleted_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

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
        Schema::dropIfExists('sector_reports');
    }
};
