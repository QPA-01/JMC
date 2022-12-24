<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid', 45)->index('uuis_index');
            $table->unsignedBigInteger('equipament_id')->index('loan_detail_eequipament_fk_idx');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('user_loan_id')->index('loan_detail_users_fk_idx');
            $table->boolean('status')->nullable()->default(true);
            $table->dateTime('created_at');
            $table->unsignedBigInteger('user_creator')->index('loan_detail_user_creator_idx');
            $table->dateTime('updated_at')->nullable();
            $table->unsignedBigInteger('user_last_update')->nullable()->index('loan_detail_user_last_update_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_detail');
    }
}
