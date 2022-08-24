<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('feature_id')->constrained('features');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }
}
