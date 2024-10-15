<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class UpdateTasksTableMakeImageNullable extends Migration
{
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            // Verifica si la columna 'image' no existe antes de agregarla
            if (!Schema::hasColumn('profiles', 'image')) {
                $table->string('image')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            // Solo modifica la columna si existe
            if (Schema::hasColumn('profiles', 'image')) {
                $table->string('image')->nullable(false)->change();
            }
        });
    }
}
