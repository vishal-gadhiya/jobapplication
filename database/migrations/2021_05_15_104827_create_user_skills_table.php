<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_skills', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('skill_id');
            $table->foreign('skill_id')
                ->references('id')
                ->on('skills')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->boolean('is_checked')->default(false);
            $table->boolean('is_beginer')->default(false);
            $table->boolean('is_mediator')->default(false);
            $table->boolean('is_expert')->default(false);
            
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
        Schema::dropIfExists('user_skills');
    }
}
