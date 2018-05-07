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
            $table->increments('id');
            $table->string('firstname', 150);
            $table->string('surname', 150);
            $table->string('internship_preference')->nullable();
            $table->integer('internship_duration')->nullable()->unsigned();
            $table->text('resumeurl_interactive')->nullable();
            $table->text('resumeurl_static')->nullable();
            $table->string('portraiturl')->nullable();
            $table->string("screenshoturl")->nullable();
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
        Schema::dropIfExists('students');
    }
}
