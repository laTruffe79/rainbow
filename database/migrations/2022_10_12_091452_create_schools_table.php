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
        Schema::create('schools',function (Blueprint $table){
            $table->id()->autoIncrement();
            $table->string('name',100);
            $table->string('phone',10)->nullable();
            $table->string('email',100)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('schools');
        Schema::enableForeignKeyConstraints();
    }
};
