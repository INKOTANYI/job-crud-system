<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id('application_id');
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('registration_id');
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->foreign('job_id')->references('job_id')->on('jobs')->onDelete('cascade');
            $table->foreign('registration_id')->references('id')->on('registrations')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};