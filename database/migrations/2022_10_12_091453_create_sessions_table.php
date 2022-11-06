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
        try {
            Schema::create('sessions', function (Blueprint $table) {
                $table->id()->autoIncrement();
                $table->unsignedBigInteger('survey_id');
                $table->foreign('survey_id')
                    ->references('id')
                    ->on('surveys')
                    ->onDelete('cascade');
                $table->unsignedBigInteger('animator_id');
                $table->foreign('animator_id')
                    ->references('id')
                    ->on('animators');
                $table->unsignedBigInteger('school_id');
                $table->foreign('school_id')
                    ->references('id')
                    ->on('schools');
                $table->boolean('open')->default(0);
                $table->binary('qrcode');
                $table->string('slug', 100);
                $table->float('satisfaction_rate', 2, 1)->nullable();
                $table->string('title',50);
                $table->timestamps();
                $table->softDeletes();
            });
        } catch (Exception $e) {
            $this->down();
            dd($e->getMessage());
        }
    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('sessions');
        Schema::enableForeignKeyConstraints();
    }
};
