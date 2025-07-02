<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id('job_id');
            $table->string('job_title');
            $table->text('job_description');
            $table->text('job_qualification');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('sector_id');
            $table->unsignedBigInteger('department_id');
            $table->date('job_deadline');
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('restrict');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('restrict');
            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('restrict');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};