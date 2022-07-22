<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->constrained("users")
            ->onUpdate('cascade')
            ->onDelete('cascade');
            // $table->foreignId('cours_id')
            // ->constrained()
            // ->onUpdate('cascade')
            // ->onDelete('cascade');

            $table->string('glimpse')->default(0);
            $table->integer('status')->default(0);
            $table->integer('rank')->default(0);
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
        Schema::dropIfExists('teachers');
    }
}