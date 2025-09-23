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
            // Kolom untuk ID pengguna, boleh null untuk user yg blm login(?)
            $table->string('user_id')->nullable(); 
            $table->string('event_name');  
            $table->string('ip_address')->nullable(); 
            $table->jsonb('event_properties')->nullable();
            $table->timestamps();
            //enih untuk data sementara ya!
            //enrichment ntr dl, i have to get user id.. 
            
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
