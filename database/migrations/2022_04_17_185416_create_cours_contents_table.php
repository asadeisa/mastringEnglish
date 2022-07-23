<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cours_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cours_id')
            ->constrained("cours")
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string("grammar_type")->nullable();
            $table->string("voc_type")->nullable();
            $table->string("img")->nullable();
            $table->string("video")->nullable();
            $table->string("text")->nullable();
            $table->string("description");

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
        Schema::dropIfExists('cours_contents');
    }
}
