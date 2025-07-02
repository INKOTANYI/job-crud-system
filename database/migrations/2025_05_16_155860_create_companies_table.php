<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('logo')->nullable();
            $table->text('description')->nullable();
            $table->string('location');
            $table->foreignId('province_id')->constrained()->onDelete('cascade');
            $table->foreignId('district_id')->constrained()->onDelete('cascade');
            $table->foreignId('sector_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained('job_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
