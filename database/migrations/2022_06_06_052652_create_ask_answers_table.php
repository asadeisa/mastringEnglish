<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAskAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ask_answers', function (Blueprint $table) {
            $table->id();     
            $table->foreignId('user_id')
            ->constrained("users")
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('ask_id')
            ->constrained("ask_questions")
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string("ans");
            $table->string("voice")->nullable();
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
        Schema::dropIfExists('ask_answers');
    }
}
