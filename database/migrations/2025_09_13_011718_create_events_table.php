<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            // $table->string('user_id')->nullable();
            $table->foreignId('user_id');
            $table->string('event_name');  
            $table->string('ip_address')->nullable(); 
            $table->jsonb('event_properties')->nullable();
            $table->jsonb('v_enrichment')->nullable(); //enrichment data.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }

    public function __construct()
    {
        
    }
};
