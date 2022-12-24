<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * CreateDocumentTypeTable
 */
class CreateDocumentTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid', 36)->nullable()->index('tipo_documento_uuid_index');
            $table->string('name', 245);
            $table->string('abbreviation');
            $table->boolean('status')->nullable()->default(true);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->unsignedBigInteger('user_creator')->nullable()->index('tipo_documento_user_creator_foreign');
            $table->unsignedBigInteger('user_last_update')->nullable()->index('tipo_documento_user_last_update_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_type');
    }
}
