<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * 21-07-2023 create table available_purposes and breaks the link between purposes and answers in order to reuse a
 * survey after editing it
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('available_purposes', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('key',50);
            $table->text('purpose_type',50);
            $table->tinyInteger('order');
            $table->string('label')->nullable();
            $table->string('icon',50)->nullable();
            $table->boolean('satisfied');
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::table('purposes',function(Blueprint $table){

            $table->unsignedBigInteger('available_purpose_id');
            $table->foreign('available_purpose_id')
                ->references('id')
                ->on('available_purposes')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('available_purposes');
    }
};
