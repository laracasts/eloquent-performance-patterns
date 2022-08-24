<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (config('database.default') === 'pgsql') {
            DB::statement('CREATE EXTENSION IF NOT EXISTS postgis');
        }

        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color', 7);
            $table->geometry('geometry');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regions');

        if (config('database.default') === 'pgsql') {
            DB::statement('DROP EXTENSION IF EXISTS postgis');
        }
    }
}
