<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
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

        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('address', 50);
            $table->string('city', 25);
            $table->string('state', 2);
            $table->string('postal', 7);
            $table->point('location', 4326);
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
        Schema::dropIfExists('stores');

        if (config('database.default') === 'pgsql') {
            DB::statement('DROP EXTENSION IF EXISTS postgis');
        }
    }
}
