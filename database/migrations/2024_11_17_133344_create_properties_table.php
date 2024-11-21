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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('property_number')->nullable()->unique();
            $table->string('description');
            $table->string('serial_number')->nullable();
            $table->string('engine_number')->nullable();
            $table->string('elc_number')->nullable();
            $table->string('office');
            $table->date('date_purchase')->nullable();
            $table->string('accountable_person')->nullable();
            $table->decimal('acquisition_cost', 15, 2)->nullable();
            $table->string('user')->nullable();
            $table->string('status')->nullable();
            $table->text('inventory_remarks')->nullable();
            $table->timestamps();
        });
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name')->nullable()->unique();
            $table->timestamps();
        });
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->string('office_name')->nullable()->unique();
            $table->timestamps();
        });
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status_name')->nullable()->unique();
            $table->timestamps();
        });
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_name')->nullable()->unique();
            $table->timestamps();
        });
    
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
