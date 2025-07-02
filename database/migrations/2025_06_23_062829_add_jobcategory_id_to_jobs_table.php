<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->unsignedBigInteger('jobcategory_id')->nullable()->after('job_qualification');
            $table->foreign('jobcategory_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropForeign(['jobcategory_id']);
            $table->dropColumn('jobcategory_id');
        });
    }
};