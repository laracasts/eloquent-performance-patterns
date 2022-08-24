<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (config('database.default') === 'mysql') {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->foreignId('company_id')->constrained('companies');
                $table->string('first_name');
                $table->string('first_name_normalized')->virtualAs("regexp_replace(first_name, '[^A-Za-z0-9]', '')")->index();
                $table->string('last_name');
                $table->string('last_name_normalized')->virtualAs("regexp_replace(last_name, '[^A-Za-z0-9]', '')")->index();
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
        }

        if (config('database.default') === 'sqlite') {
            throw new \Exception('This lesson does not support SQLite.');
        }

        if (config('database.default') === 'pgsql') {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->foreignId('company_id')->constrained('companies');
                $table->string('first_name');
                $table->string('last_name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
                $table->rawIndex("regexp_replace(first_name, '[^A-Za-z0-9]', '')", 'users_first_name_normalized_index');
                $table->rawIndex("regexp_replace(last_name, '[^A-Za-z0-9]', '')", 'users_last_name_normalized_index');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
