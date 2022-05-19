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
            $table->string('email')->unique();
            $table->double('money', 2)->unsigned()->default(20000);
            $table->integer('happy')->unsigned()->default(100);
            $table->integer('health')->unsigned()->default(100);
            $table->integer('energy')->unsigned()->default(100);
            $table->integer('impact')->unsigned()->default(0);
            $table->integer('popularity')->unsigned()->default(0);
            $table->integer('age')->unsigned()->default(18);
            $table->integer('level_game')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
