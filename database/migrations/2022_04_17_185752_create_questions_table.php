<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')
            ->constrained("tests")
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string("question");
            $table->string("true_ans")->default(0);
            $table->string("option1")->default(0);
            $table->string("option2")->default(0);
            $table->string("option3")->default(0);
            $table->string("option4")->default(0);
            $table->boolean("sortabll")->default(0);
            $table->boolean("translat_sent")->default(0);
            $table->string("difficulty");
            $table->string("freq");
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
        Schema::dropIfExists('questions');
    }
}
