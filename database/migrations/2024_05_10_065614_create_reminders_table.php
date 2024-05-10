<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->tinyInteger('alarm');
            $table->date('datereminder')->nullable();
            $table->time('hourreminder')->nullable();
            $table->unsignedBigInteger('profileid');
            $table->timestamps();

            // Define la clave foránea
            $table->foreign('profileid')->references('id')->on('profiles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reminders');
    }
}
