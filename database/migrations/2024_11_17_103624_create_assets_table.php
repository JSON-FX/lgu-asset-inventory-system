<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();  // Auto-increment ID
            $table->string('name');  // Name of the asset
            $table->text('description')->nullable();  // Description of the asset
            $table->string('asset_code')->unique();  // Unique code for the asset
            $table->foreignId('category_id')->nullable()->constrained('categories');  // Foreign key to categories
            $table->foreignId('location_id')->nullable()->constrained('locations');  // Foreign key to locations
           // $table->enum('condition', ['new', 'used', 'damaged'])->default('new');  // Condition of the asset
           // $table->enum('status', ['available', 'assigned', 'in_repair', 'retired'])->default('available');  // Status of the asset
            $table->date('purchase_date')->nullable();  // Purchase date
            $table->decimal('purchase_price', 10, 2)->nullable();  // Purchase price
            $table->string('serial_number')->nullable()->unique();  // Serial number
            $table->timestamps();  // Created at, updated at
        });
    }

    public function down()
    {
        Schema::dropIfExists('assets');
    }
}