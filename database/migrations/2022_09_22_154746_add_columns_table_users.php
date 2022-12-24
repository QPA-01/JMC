<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('uuid')->after('id');
            $table->bigInteger('rol_id')->after('password')->unsigned();
            $table->bigInteger('document_type_id')->after('rol_id')->unsigned();
            $table->bigInteger('document_number')->after('document_type_id')->unique()->unsigned();
            $table->bigInteger('phone')->after('document_number')->unsigned()->nullable()->unique();
            $table->string('date_birth')->after('phone');
            $table->string('address')->after('date_birth')->nullable();
            $table->boolean('status')->nullable()->default(true)->after('remember_token');
            $table->bigInteger('user_creator')->nullable()->after('created_at')->unsigned();
            $table->bigInteger('user_last_update')->nullable()->after('updated_at')->unsigned();
            $table->foreign('document_type_id')->references('id')->on('document_type');
            $table->foreign('rol_id')->references('id')->on('role');
            $table->foreign('user_creator')->references('id')->on('users');
            $table->foreign('user_last_update')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
