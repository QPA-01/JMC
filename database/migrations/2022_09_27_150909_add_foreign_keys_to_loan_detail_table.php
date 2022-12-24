<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToLoanDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loan_detail', function (Blueprint $table) {
            $table->foreign(['equipament_id'], 'loan_detail_equipament_fk')->references(['id'])->on('equipment')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_last_update'], 'loan_detail_user_last_update')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_creator'], 'loan_detail_user_creator')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_loan_id'], 'loan_detail_users_fk')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loan_detail', function (Blueprint $table) {
            $table->dropForeign('loan_detail_equipament_fk');
            $table->dropForeign('loan_detail_user_last_update');
            $table->dropForeign('loan_detail_user_creator');
            $table->dropForeign('loan_detail_users_fk');
        });
    }
}
