<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMistakesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mistakes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->constrained("users")
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('question_id')
            ->constrained("questions")
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('progress_id')
            ->constrained("progress")
            ->onUpdate('cascade')
            ->onDelete('cascade')
            ->nullable();
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
        Schema::dropIfExists('mistakes');
    }
}

