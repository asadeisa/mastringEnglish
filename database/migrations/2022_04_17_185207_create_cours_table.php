<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cours', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('teacher_id')
            ->constrained("teachers")
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->integer("level")->default(1);
            $table->string("hit_type");// gramer or vocabs
            $table->string("description");
            $table->integer('rank')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cours');
    }
}

