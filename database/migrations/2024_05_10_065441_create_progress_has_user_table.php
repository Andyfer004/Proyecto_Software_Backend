<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressHasUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress_has_user', function (Blueprint $table) {
            $table->id();
            $table->decimal('progress', 10, 2);
            $table->integer('week');
            $table->unsignedBigInteger('userid');
            $table->timestamps();

            // Define la clave foránea
            $table->foreign('userid')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progress_has_user');
    }
}
