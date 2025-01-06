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
        // Create categories table
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name')->unique()->nullable();
            $table->timestamps();
        });

        // Create offices table
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->string('office_name')->unique()->nullable();
            $table->timestamps();
        });

        // Create statuses table
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status_name')->unique()->nullable();
            $table->timestamps();
        });

        // Create employees table
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_name')->unique()->nullable();
            $table->timestamps();
        });

        // Create properties table
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('property_number')->unique()->nullable();
            $table->string('description');
            $table->string('serial_number')->nullable();
            $table->string('engine_number')->nullable();
            $table->string('elc_number')->nullable();
            $table->foreignId('office_id')->constrained('offices')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('status_id')->constrained('statuses')->onDelete('cascade');
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->foreignId('employee_id2')->constrained('employees')->onDelete('cascade');
            $table->date('date_purchase')->nullable();
            $table->decimal('acquisition_cost', 15, 2)->nullable();
            $table->decimal('qty', 15, 2)->nullable();
            $table->text('inventory_remarks')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('statuses');
        Schema::dropIfExists('offices');
        Schema::dropIfExists('categories');
    }
};
