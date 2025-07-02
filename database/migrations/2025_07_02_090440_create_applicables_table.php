<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicablesTable extends Migration
{
    public function up()
    {
        Schema::create('applicables', function (Blueprint $table) {
            $table->id();
            $table->string('names', 255);
            $table->string('phone', 13)->unique();
            $table->string('email', 255)->unique();
            $table->string('id_number', 16)->unique();
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('sector_id');
            $table->unsignedBigInteger('job_id');
            $table->string('cv')->nullable();
            $table->string('degree')->nullable();
            $table->string('id_doc')->nullable();
            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('cascade');
            $table->foreign('job_id')->references('job_id')->on('jobs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('applicables');
    }

};
