<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToDocumentTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('document_type', function (Blueprint $table) {
            $table->foreign(['user_last_update'], 'tipo_documento_user_last_update_foreign')->references(['id'])->on('users');
            $table->foreign(['user_creator'], 'tipo_documento_user_creator_foreign')->references(['id'])->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_type', function (Blueprint $table) {
            $table->dropForeign('tipo_documento_user_last_update_foreign');
            $table->dropForeign('tipo_documento_user_creator_foreign');
        });
    }
}
