<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_asset_assignments_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetAssignmentsTable extends Migration
{
    public function up()
    {
        Schema::create('asset_assignments', function (Blueprint $table) {
            $table->id();  // Auto-increment ID
            $table->foreignId('asset_id')->constrained('assets');  // Foreign key to assets table
            $table->foreignId('user_id')->constrained('users');  // Foreign key to users table
            $table->timestamp('assignment_date')->useCurrent();  // Assignment date
            $table->timestamp('return_date')->nullable();  // Nullable return date
            $table->timestamps();  // Created at, updated at
        });
    }

    public function down()
    {
        Schema::dropIfExists('asset_assignments');
    }
}
