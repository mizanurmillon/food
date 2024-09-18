<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->integer('user_id')->nullable();
            $table->string('title')->nullable();
            $table->string('title_slug')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->string('created_date')->nullable();
            $table->string('created_month')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('blogcategories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
