<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientAdmissionFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_admission_facilities', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->smallInteger('bed_id')->unsigned()->index()->nullable();
            $table->foreign('bed_id')->references('id')->on('beds')->onDelete('cascade');
            $table->integer('admission_id')->unsigned()->index();
            $table->foreign('admission_id')->references('id')->on('patient_admissions')->onDelete('cascade');
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
        Schema::dropIfExists('patient_admission_facilities');
    }
}
