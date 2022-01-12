<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('mobile')->unique();
            $table->string('firstname',150);
            $table->string('lastname',150);
            $table->string('middlename',100);
            $table->string('suffix',10)->nullable();
            $table->string('gender',8);
            $table->date('birthday');
            $table->string('address');
            $table->integer('barangay_id')->unsigned()->index();
            $table->foreign('barangay_id')->references('id')->on('barangays')->onDelete('cascade');
            $table->boolean('is_vaccinated')->default(0);
            $table->string('vaccine')->default('n/a');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
