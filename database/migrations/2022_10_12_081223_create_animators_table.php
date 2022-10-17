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
        Schema::create('animators',function (Blueprint $table){
            $table->id()->autoIncrement();
            $table->string('name',50);
            $table->string('email',100);
        });
    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('animators');
        Schema::enableForeignKeyConstraints();
    }
};
