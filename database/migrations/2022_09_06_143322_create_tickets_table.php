<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->boolean('winner')->default(false);
            $table->uuid('code');
            $table->json('numbers');

            $table->unsignedBigInteger('prize_id')->default(null)->nullable();
            $table->foreign('prize_id')->references('id')->on('prizes');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
