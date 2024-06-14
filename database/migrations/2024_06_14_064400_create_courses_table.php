<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::create('courses', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID (Primary Key)
            $table->string('title'); // Title (String)
            $table->string('description'); // Description (Text)
            $table->boolean('status');
            $table->timestamps(); // created_at and updated_at (Timestamps)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
