<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('subtraction_histories', function (Blueprint $table) {
            $table->string('session_id')->nullable()->after('is_correct');
        });
    }

    public function down()
    {
        Schema::table('subtraction_histories', function (Blueprint $table) {
            $table->dropColumn('session_id');
        });
    }
};
