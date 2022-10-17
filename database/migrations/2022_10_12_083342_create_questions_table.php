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
        Schema::create('questions',function (Blueprint $table){
            $table->id()->autoIncrement();
            $table->text('question');
            $table->string('image',200);
            $table->timestamps();
            $table->softDeletes();
        });

    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('questions');
        Schema::enableForeignKeyConstraints();
    }
};
