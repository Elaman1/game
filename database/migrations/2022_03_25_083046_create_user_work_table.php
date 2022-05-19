<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_work', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unique();
            $table->integer('work_id')->nullable()->unsigned();
            $table->boolean('active')->default(0);
            $table->integer('chance_up')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_work');
    }
}
