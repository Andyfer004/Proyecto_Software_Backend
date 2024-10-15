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
            $table->tinyInteger('alarm');  // tinyInteger para alarma (0 o 1)
            $table->date('datereminder')->nullable();
            $table->time('hourreminder')->nullable();
            $table->unsignedBigInteger('profileid');
            $table->unsignedBigInteger('priorityid');  // Relacionado con prioridades
            $table->timestamps();

            // Definir claves foráneas
            $table->foreign('profileid')->references('id')->on('profiles');
            $table->foreign('priorityid')->references('id')->on('priorities');
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
