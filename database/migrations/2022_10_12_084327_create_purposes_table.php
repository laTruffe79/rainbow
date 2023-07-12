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
        try{
            Schema::create('purposes',function (Blueprint $table){
                $table->id()->autoIncrement();
                $table->unsignedBigInteger('question_id');
                $table->foreign('question_id')
                    ->references('id')
                    ->on('questions')
                    ->onDelete('cascade');
                $table->string('key',50);
                $table->tinyInteger('order');
                $table->string('label')->nullable();
                $table->string('icon',50)->nullable();
                $table->boolean('satisfied');
                $table->timestamps();
                $table->softDeletes();
            });
        }
        catch (Exception $exception)
        {
            $this->down();
            dd($exception->getMessage());
        }

    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('purposes');
        Schema::enableForeignKeyConstraints();
    }
};
