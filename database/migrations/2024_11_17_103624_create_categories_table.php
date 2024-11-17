<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_categories_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();  // Auto-increment ID
            $table->string('name')->unique();  // Category name, unique
            $table->text('description')->nullable();  // Description of the category
            $table->timestamps();  // Created at, updated at
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
