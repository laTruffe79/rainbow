<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('participants',function (Blueprint $table){
            $table->id()->autoIncrement();
            $table->string('pseudo',50)->nullable();
            $table->float('satisfaction_rate',2,1);

            $table->unsignedBigInteger('session_id');
            $table->foreign('session_id')
                ->references('id')
                ->on('sessions')
                ->onDelete('cascade');
            $table->string('token',45);
            $table->unsignedBigInteger('question_id')
                ->nullable();
            $table->foreign('question_id')
                ->references('id')
                ->on('questions');
            $table->unsignedBigInteger('last_question_id');
            $table->foreign('last_question_id')
                ->references('id')
                ->on('questions');
            $table->boolean('token_is_valid')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('participants');
        Schema::enableForeignKeyConstraints();
    }
};
