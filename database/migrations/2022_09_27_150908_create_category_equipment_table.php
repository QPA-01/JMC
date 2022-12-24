<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_equipment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid', 45)->index('uuid_index');
            $table->string('name', 245);
            $table->text('description')->nullable();
            $table->boolean('status')->nullable()->default(true);
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->unsignedBigInteger('user_creator')->index('user_creator_category_equipament_idx');
            $table->unsignedBigInteger('user_last_update')->nullable()->index('user_last_update_category_equipament_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_equipment');
    }
}
