<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_admissions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('exit_port');
            $table->boolean('is_positive')->nullable();
            $table->boolean('is_home')->default(1);
            $table->date('started_at');
            $table->date('completion_at');
            $table->boolean('is_released')->default(0);
            $table->tinyInteger('status_id')->unsigned()->index()->nullable();
            $table->foreign('status_id')->references('id')->on('dropdowns')->onDelete('cascade');
            $table->integer('patient_id')->unsigned()->index();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
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
        Schema::dropIfExists('patient_admissions');
    }
}
