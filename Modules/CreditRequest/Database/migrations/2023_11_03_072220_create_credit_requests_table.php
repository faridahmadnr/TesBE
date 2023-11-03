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
        Schema::create('credit_requests', function (Blueprint $table) {
            $table->id();
            $table->char('registration_number', 12);
            $table->foreignId('user_id')
                ->index()
                ->constrained('users')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('business_type_id')
                ->index()
                ->constrained('business_types')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('business_permit_id')
                ->index()
                ->constrained('business_permits')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->string('business_tin')
                ->comment('NPWP (Taxpayer Identification Number)')
                ->nullable();

            $table->string('image')->nullable();
            $table->string('business_address');
            $table->foreignId('business_regency_id')
                ->index()
                ->constrained('regencies')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('business_district_id')
                ->index()
                ->constrained('districts')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->string('village');
            $table->string('postal_code');

            $table->foreignId('credit_request_type_id')
                ->index()
                ->constrained('credit_request_types')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('termin_id')
                ->index()
                ->constrained('termins')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('bank_id')
                ->index()
                ->constrained('banks')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->integer('amount');

            $table->tinyInteger('status')->default(1);

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
        Schema::dropIfExists('credit_requests');
    }
};
