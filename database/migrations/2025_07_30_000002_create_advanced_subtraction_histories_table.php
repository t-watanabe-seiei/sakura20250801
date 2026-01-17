<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('advanced_subtraction_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('minuend'); // 被減数（11～19）
            $table->integer('subtrahend'); // 減数（1～9）
            $table->integer('user_answer'); // ユーザーの解答
            $table->integer('correct_answer'); // 正答
            $table->boolean('is_correct'); // 正解かどうか
            $table->string('session_id')->nullable(); // セッションID
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advanced_subtraction_histories');
    }
};
