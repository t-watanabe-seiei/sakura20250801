<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('subtraction_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('minuend'); // 被減数
            $table->unsignedTinyInteger('subtrahend'); // 減数
            $table->unsignedTinyInteger('user_answer'); // ユーザーの解答
            $table->unsignedTinyInteger('correct_answer'); // 正答
            $table->boolean('is_correct'); // 正誤
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subtraction_histories');
    }
};
