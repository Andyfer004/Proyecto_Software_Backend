<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubtasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subtasks', function (Blueprint $table) {
            $table->id();
            $table->string('name', 500);
            $table->text('description');
            $table->unsignedBigInteger('priorityid')->nullable();
            $table->date('duedate')->nullable();
            $table->decimal('timeestimatehours', 10, 2)->nullable();
            $table->unsignedBigInteger('taskid')->nullable();
            $table->unsignedBigInteger('statusid')->nullable();
            $table->timestamps();

            // Define las claves foráneas
            $table->foreign('priorityid')->references('id')->on('priorities');
            $table->foreign('taskid')->references('id')->on('tasks');
            $table->foreign('statusid')->references('id')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subtasks');
    }
}
