<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
        $table->id();
        $table->string('image');
        $table->string('coursename');
        $table->text('coursedetail');
        $table->string('semester');
        $table->string('slug')->unique();
        $table->boolean('featured')->default(0);
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
        Schema::dropIfExists('courses');
    }
}
