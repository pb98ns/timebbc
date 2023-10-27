<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('months', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('firm_id')->unsigned();
            $table->biginteger('user_id')->unsigned();
            $table->biginteger('user_id2')->unsigned()->nullable();
            $table->date('close_date')->nullable();
            $table->time('close_time')->nullable();
            $table->date('close_date2')->nullable();
            $table->time('close_time2')->nullable();
            $table->date('close_date3')->nullable();
            $table->time('close_time3')->nullable();
            $table->string('uwagi')->nullable();
            $table->string('uwagidokorekty')->nullable();
            $table->string('status1')->nullable();
            $table->string('amortyzacja')->nullable();
            $table->string('cit')->nullable();
            $table->string('jpk')->nullable();
            $table->string('vat')->nullable();
            $table->string('pit5_cit')->nullable();
            $table->string('pismo')->nullable();
            $table->string('korekta')->nullable();
            $table->string('vat_ue')->nullable();
            $table->string('vat_uea')->nullable();
            $table->string('vat_ueb')->nullable();
            $table->string('vat_uec')->nullable();
            $table->string('vat_27')->nullable();
            $table->string('akc')->nullable();
            $table->string('cit_st')->nullable();
            $table->string('uwagidodeklaracji')->nullable();
            $table->string('przelew')->nullable();
            $table->foreign('firm_id')->references('id')->on('firms')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id2')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('months');
    }
}
