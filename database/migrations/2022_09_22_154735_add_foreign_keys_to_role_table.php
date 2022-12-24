<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('role', function (Blueprint $table) {
            $table->foreign(['user_last_update'], 'rol_user_last_update_foreign')->references(['id'])->on('users');
            $table->foreign(['user_creator'], 'rol_user_creator_foreign')->references(['id'])->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('role', function (Blueprint $table) {
            $table->dropForeign('rol_user_last_update_foreign');
            $table->dropForeign('rol_user_creator_foreign');
        });
    }
}
