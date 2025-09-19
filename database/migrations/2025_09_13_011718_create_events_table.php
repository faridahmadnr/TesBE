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
            // Nama aktivitas (misal 'klik_button')
            $table->string('event_name'); 
            // Halaman tempat aktivitas terjadi
            $table->string('page_name')->nullable(); 
            // Alamat IP user
            $table->string('ip_address')->nullable(); 
            // Detail event dalam format JSON
            $table->jsonb('event_properties')->nullable();
            // Kolom otomatis untuk created_at dan updated_at, enrichment sementara...
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
