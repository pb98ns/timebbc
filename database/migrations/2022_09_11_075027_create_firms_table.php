<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('number')->nullable();
            $table->text('place')->nullable();
            $table->string('nip')->nullable();
            $table->string('status')->default('Aktywny');
            $table->string('kpir')->nullable();
            $table->string('kh')->nullable();
            $table->string('placezus')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('firms');
    }
}
