<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class AddDeletedAtToOfficesTable extends Migration
{
    public function up()
    {
        Schema::table('offices', function (Blueprint $table) {
            $table->softDeletes(); // Adds a `deleted_at` column
        });
    }

    public function down()
    {
        Schema::table('offices', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
