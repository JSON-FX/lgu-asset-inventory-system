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
        
        

        // Add soft deletes to properties table
        Schema::table('properties', function (Blueprint $table) {
            $table->softDeletes();
        });

    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        // Drop soft deletes from properties table
        Schema::table('properties', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

    }
};
