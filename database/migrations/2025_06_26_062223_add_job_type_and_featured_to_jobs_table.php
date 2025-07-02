<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJobTypeAndFeaturedToJobsTable extends Migration
{
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->string('job_type')->default('full_time'); // Add job_type as a string
            $table->boolean('featured')->default(false);     // Add featured as a boolean
        });
    }

    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn(['job_type', 'featured']);
        });
    }
}