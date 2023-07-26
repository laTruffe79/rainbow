<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    /**
     * @return void
     */
    public function up(): void
    {
        try {
            Schema::create('answers', function (Blueprint $table) {
                $table->id()->autoIncrement();

                $table->unsignedBigInteger('participant_id');
                $table->foreign('participant_id')
                    ->references('id')
                    ->on('participants')
                    ->onDelete('cascade');

                $table->unsignedBigInteger('question_id');
                $table->foreign('question_id')
                    ->references('id')
                    ->on('questions');

                $table->unsignedBigInteger('available_purpose_id');
                $table->foreign('available_purpose_id')
                    ->references('id')
                    ->on('available_purposes');

                $table->unsignedBigInteger('session_id');
                $table->foreign('session_id')
                    ->references('id')
                    ->on('sessions')
                    ->onDelete('cascade');

                $table->text('comment')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        } catch (Exception $e) {
            $this->down();
            echo $e->getMessage();
        }
    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('answers');
        Schema::enableForeignKeyConstraints();
    }
};
