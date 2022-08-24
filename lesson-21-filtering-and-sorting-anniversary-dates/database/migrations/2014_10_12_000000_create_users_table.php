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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('birth_date')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            if (config('database.default') === 'mysql') {
                $table->rawIndex("(date_format(birth_date, '%m-%d')), name", 'users_birthday_name_index');
            }

            if (config('database.default') === 'sqlite') {
                $table->rawIndex("(strftime('%m-%d', birth_date)), name", 'users_birthday_name_index');
            }

            if (config('database.default') === 'pgsql') {
                DB::unprepared('
                    create or replace function to_birthday(date timestamp)
                    returns text language sql immutable as
                    $f$ select to_char($1, \'MM-DD\') $f$
                ');

                $table->rawIndex('to_birthday(birth_date), name', 'users_birthday_name_index');
            }
        });
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
