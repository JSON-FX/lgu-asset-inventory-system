<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_asset_history_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetHistoryTable extends Migration
{
    public function up()
    {
        Schema::create('asset_history', function (Blueprint $table) {
            $table->id();  // Auto-increment ID
            $table->foreignId('asset_id')->constrained('assets');  // Foreign key to assets table
            $table->foreignId('user_id')->constrained('users');  // Foreign key to users table
            $table->enum('action', ['assigned', 'returned', 'repair', 'retired']);  // Action performed on the asset
            $table->text('comment')->nullable();  // Optional comment
            $table->timestamp('action_date')->useCurrent();  // Date of the action
            $table->timestamps();  // Created at, updated at
        });
    }

    public function down()
    {
        Schema::dropIfExists('asset_history');
    }
}
