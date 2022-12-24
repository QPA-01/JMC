<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('equipment', function (Blueprint $table) {
            $table->foreign(['category_equipment_id'], 'cateroty_equipament_fk')->references(['id'])->on('category_equipment')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_last_update'], 'user_last_update_fk')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_creator'], 'user_creator_fk')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equipment', function (Blueprint $table) {
            $table->dropForeign('cateroty_equipament_fk');
            $table->dropForeign('user_last_update_fk');
            $table->dropForeign('user_creator_fk');
        });
    }
}
