<?php

// database/migrations/YYYY_MM_DD_create_calendar_entries_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarEntriesTable extends Migration
{
    public function up()
    {
        Schema::create('calendar_entries', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->decimal('total_assets')->default(0); // Total assets for that day
            $table->string('description')->nullable(); // Optional description for the day
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('calendar_entries');
    }
}

