<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('mood_records', function (Blueprint $table) {
        $table->unsignedTinyInteger('stress_level')->after('mood_level');
    });
}

public function down()
{
    Schema::table('mood_records', function (Blueprint $table) {
        $table->dropColumn('stress_level');
    });
}
};
