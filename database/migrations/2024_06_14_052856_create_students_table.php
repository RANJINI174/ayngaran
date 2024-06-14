<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('students', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID (Primary Key)
            $table->string('name'); // Name (String)
            $table->string('email')->unique();// Email (String, Unique)
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
        Schema::dropIfExists('students');
    }
}
