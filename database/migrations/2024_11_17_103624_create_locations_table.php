<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();  // Auto-increment ID
            $table->string('name')->unique();  // Location name, unique
            $table->text('description')->nullable();  // Description of the location
            $table->timestamps();  // Created at, updated at
        });
    }

    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
