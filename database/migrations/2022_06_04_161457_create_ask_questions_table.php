<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAskQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ask_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->constrained("users")
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string("a_question")->nullable();
            $table->string("a_sentenses")->nullable();
            $table->string("a_question_type")->nullable();
            $table->string("a_voice")->nullable();
            
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
        Schema::dropIfExists('ask_questions');
    }
}
