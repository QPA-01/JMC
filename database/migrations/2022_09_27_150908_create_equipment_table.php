<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid', 45)->index('uuid_index');
            $table->string('name', 45);
            $table->unsignedBigInteger('category_equipment_id')->index('cateroty_equipament_fk_idx');
            $table->unsignedInteger('quantity')->nullable()->default(0);
            $table->boolean('status')->nullable()->default(true);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->unsignedBigInteger('user_creator')->index('user_creator_fk_idx');
            $table->unsignedBigInteger('user_last_update')->nullable()->index('user_last_update_fk_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment');
    }
}
